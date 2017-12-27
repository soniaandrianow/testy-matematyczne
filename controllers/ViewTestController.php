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
use app\models\Difficulties;
use app\models\Tasks;

class ViewTestController extends Controller
{

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

        return $this->renderAjax('_categories', [
            //'categories' => $categories,
            'difficulty' => $id,
            'main_cat' => $mainCat,
        ]);
    }
}