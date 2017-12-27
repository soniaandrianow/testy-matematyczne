<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 25.12.2017
 * Time: 14:37
 */

namespace app\controllers;


use app\components\Controller;
use app\models\Categories;
use app\models\Children;
use app\models\Difficulties;
use app\models\forms\TestForm;
use app\models\Solutions;
use app\models\Tasks;
use app\models\Tests;
use yii\db\Connection;
use yii\db\Exception;
use yii\db\Expression;
use yii\db\Transaction;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use Yii;

class TestsController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create-test', 'run-test', 'first-question', 'previous-question', 'next-question', 'answer-question', 'cancel', 'finish-test'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    // everything else is denied
                ],
            ],
        ];
    }

    public function actionDifficulty($id)
    {
        $tasks = array_column(Tasks::find()->where(['DifficultyId' => $id])->select('TaskId')->asArray()->all(), 'TaskId');

        $mainCat = array_column(Categories::find()->where(['CategoryId' => $tasks])->select('MainCategory')->distinct()->asArray()->all(), 'MainCategory');

        $categories = Categories::find()->where(['CategoryId' => $tasks])->all();

        $html = $this->renderPartial('_categories', [
            'categories' => $categories,
            'difficulty' => $id,
            'main_cat' => $mainCat,
        ]);
        return \yii\helpers\Json::encode($html);

//        return $this->renderAjax('_categories', [
//            'categories' => $categories,
//            'difficulty' => $id,
//            'main_cat' => $mainCat,
//        ]);
    }

    public function actionCreateTest($difficulty_id, $category_id)
    {
        $testForm = new TestForm();

        $tasks = Tasks::find()->where(['CategoryId' => $category_id])->andWhere(['DifficultyId' => $difficulty_id])->orderBy(new Expression('rand()'))->limit(Yii::$app->params['max_questions'])->all();

        $category = Categories::findOne($category_id);
        $difficulty = Difficulties::findOne($difficulty_id);

        $kids = ArrayHelper::map(Children::find()->where(['ParentId' => Yii::$app->user->id])->all(), 'ChildId', 'FirstName');

        $testForm->tasks = $tasks;
        $testForm->category = $category;
        $testForm->difficulty = $difficulty;

        if($testForm->load(Yii::$app->request->post())) {
            if($testForm->validate()) {
                $test = new Tests();
                $points = 0;
                foreach($tasks as $task) {
                    //var_dump($task);
                    $points += $task->NumberOfPoints;
                }
                //die;
                $test->MaximumPoints = $points;
                $test->GeneratedDate = date('Y-m-d H:i:s', strtotime("now"));
                $test->ChildId = $testForm->child;
                $test->CategoryId = $category_id;
                $test->DifficultyId = $difficulty_id;
                $test->CategoryMainName = $category->MainCategory;
                if($test->validate() && $test->save()) {
                    Yii::$app->session['testForm'] = $testForm;
                    Yii::$app->session['test'] = $test;
                    $this->redirect(['tests/run-test']);
                } else {
                    $this->err("Nie udało się uruchomić testu. Spróbuj ponownie później.");
                }
            } else {
                $this->err("Nie udało się uruchomić testu. Spróbuj ponownie później.");
            }
        }

        return $this->render('start-test', [
            'tasks' => $tasks,
            'difficulty' => $difficulty,
            'category' => $category,
            'model' => $testForm,
            'kids' => $kids
        ]);

    }

    public function actionRunTest()
    {
        $this->layout = 'test-layout';
        Yii::$app->session['question_id'] = 0;
        $tasks = Yii::$app->session['testForm']->tasks;
        $ans = [];
        foreach($tasks as $task) {
            $ans[] = [
                'task' => $task->TaskId,
                'answer' => null
            ];
        }
        Yii::$app->session['your_answers'] = $ans;
        return $this->render('test-question', [
        ]);
    }

    public function actionFirstQuestion()
    {
        return $this->renderAjax('_question', []);
    }

    public function actionAnswerQuestion($id)
    {

        $session = Yii::$app->session;
        $qi = $session->get('question_id');
        $task = $session->get('testForm')->tasks[$qi]->TaskId;
        $ya = $session->get('your_answers');
        $ya[Yii::$app->session['question_id']] = [
            'task' => $task,
            'answer' => $id,
            ];
        $session->set('your_answers', $ya);

        if ($qi < Yii::$app->params['max_questions']-1) {
            $qi++;
            $session->set('question_id', $qi);
        }

        return $this->renderAjax('_question', []);
    }

    public function actionPreviousQuestion()
    {
        $session = Yii::$app->session;
        $qi = $session->get('question_id');
        $qi--;
        $session->set('question_id', $qi);

        return $this->renderAjax('_question', []);
    }

    public function actionNextQuestion()
    {
        $session = Yii::$app->session;
        $qi = $session->get('question_id');
        $qi++;
        $session->set('question_id', $qi);

        return $this->renderAjax('_question', []);
    }

    public function actionCancel()
    {
        $test_id = Yii::$app->session->get('test')->TestId;
        $test = Tests::findOne($test_id);
        if($test->delete()) {
            $this->ok(Yii::t('app', 'Test został anulowany.'));
            $this->redirect(['site/index']);
        } else {
            $this->err(Yii::t('app', 'Nie udało się anulować testu. Skontaktuj się z administratorem systemu.'));
        }
    }

    public function actionFinishTest()
    {
        if(Yii::$app->session->get('your_answers')) {
            $ya = Yii::$app->session->get('your_answers');
            $tasks = Yii::$app->session->get('testForm')->tasks;
            $all_points_gained = 0;
            $transaction = Yii::$app->db->beginTransaction();
            try {
                foreach ($ya as $ans) {

                    $solution = new Solutions();
                    $solution->AnswerId = $ans['answer'];
                    $solution->TaskId = $ans['task'];
                    $solution->TestId = Yii::$app->session->get('test')->TestId;
                    $task = Tasks::findOne($ans['task']);
                    $correct = $task->getCorrect();
                    //var_dump($correct); die;
                    $points = $ans['answer'] == $correct ? $task->NumberOfPoints : 0;
                    $all_points_gained += $points;
                    $solution->PointsGained = $points;
                    if (!$solution->save()) {
                        throw new Exception();
                    }
                }
                $transaction->commit();
                $all_points = 0;
                foreach ($tasks as $t) {
                    $all_points += $t->NumberOfPoints;
                }
                $testForm = Yii::$app->session->get('testForm');
                $test = Yii::$app->session->get('test');
                Yii::$app->session->remove('your_answers');
                Yii::$app->session->remove('testForm');
                Yii::$app->session->remove('test');
                return $this->render('finished-test', [
                    'points_gained' => $all_points_gained,
                    'points' => $all_points,
                    'testForm' => $testForm,
                    'test' => $test
                ]);

            } catch (Exception $e) {
                $this->err(Yii::t('app', 'Nie udało się zapisać testu. Skontaktuj się z administratorem systemu.'));
                $this->goBack();
            }
        } else {
            $this->redirect(['site/index']);
        }
    }
}