<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 27.12.2017
 * Time: 09:40
 */

namespace app\controllers;


use app\components\Controller;
use app\models\Categories;
use app\models\Children;
use app\models\Difficulties;
use app\models\Solutions;
use app\models\Tasks;
use app\models\Tests;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class ViewTestController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }


    public function actionIndex()
    {
        $difficulties = Difficulties::find()->all();

        return $this->render('index', [
            'difficulties' => $difficulties,
        ]);
    }


    public function actionDifficulty($id)
    {
        $tasks = array_column(Tasks::find()->where(['DifficultyId' => $id])->select('TaskId')->asArray()->all(), 'TaskId');

        $mainCat = array_column(Categories::find()->where(['CategoryId' => $tasks])->select('MainCategory')->distinct()->asArray()->all(), 'MainCategory');

        //$categories = Categories::find()->where(['CategoryId' => $tasks])->all();

        $html = $this->renderPartial('_categories', [
            //'categories' => $categories,
            'difficulty' => $id,
            'main_cat' => $mainCat,
        ]);
        return \yii\helpers\Json::encode($html);

//        return $this->renderAjax('_categories', [
//            //'categories' => $categories,
//            'difficulty' => $id,
//            'main_cat' => $mainCat,
//        ]);
    }

    public function actionCategory($id, $cat)
    {
        $kids = array_column(Children::find()->where(['ParentId' => Yii::$app->user->id])->select(['ChildId'])->all(), 'ChildId');
        $kidsSelect = ArrayHelper::map(Children::find()->where(['ParentId' => Yii::$app->user->id])->all(), 'ChildId', 'FirstName');
        $kidsSelect[0] = 'Wszystkie';
        $tests_query = Tests::find()->where(['ChildId' => $kids])->andWhere(['CategoryMainName' => $cat])->andWhere(['DifficultyId' => $id]);
        $testsProvider = new ActiveDataProvider([
            'query' => $tests_query,
        ]);
       return $this->renderAjax('_tests', [
            'difficulty' => $id,
            'category' => $cat,
            'testsProvider' => $testsProvider,
            'kidsSelect' => $kidsSelect
        ]);
        //return \yii\helpers\Json::encode($html);
    }

    public function actionList($kid, $difficulty, $category)
    {
        $kids = array_column(Children::find()->where(['ParentId' => Yii::$app->user->id])->select(['ChildId'])->all(), 'ChildId');
        $kidsSelect = ArrayHelper::map(Children::find()->where(['ParentId' => Yii::$app->user->id])->all(), 'ChildId', 'FirstName');
        if($kid == 0) {
            $tests_query = Tests::find()->where(['ChildId' => $kids])->andWhere(['CategoryMainName' => $category])->andWhere(['DifficultyId' => $difficulty]);
        } else {
            $tests_query = Tests::find()->where(['ChildId' => $kid])->andWhere(['CategoryMainName' => $category])->andWhere(['DifficultyId' => $difficulty]);
        }
        $testsProvider = new ActiveDataProvider([
            'query' => $tests_query,
        ]);
        return $this->renderAjax('_list', [
            'difficulty' => $difficulty,
            'category' => $category,
            'testsProvider' => $testsProvider,
            'kidsSelect' => $kidsSelect
        ]);
    }

    public function actionDisplay($id)
    {
        $test = Tests::findOne($id);
        $solutions = Solutions::find()->where(['TestId' => $id])->all();
        $goodSolutions = Solutions::find()->where(['TestId' => $id])->andWhere(['>', 'PointsGained', 0])->all();
        $pointsGained = 0;

        foreach($solutions as $solution) {
            $pointsGained += $solution->PointsGained;
        }

        return $this->render('display' ,[
            'test' => $test,
            'solutions' => $solutions,
            'goodSolutions' => $goodSolutions,
            'pointsGained' => $pointsGained,
        ]);
    }

    public function actionAnswer($test, $task, $number, $chosen)
    {
        $task = Tasks::findOne($task);
        return $this->renderAjax('_answer', [
            'number' => $number,
            'task' => $task,
            'chosen' => $chosen,
        ]);
    }
}