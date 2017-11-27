<?php

namespace app\controllers;

use app\models\Children;
use app\models\Parents;
use yii\data\ActiveDataProvider;

class ProfileController extends \yii\web\Controller
{
    public function actionIndex($id)
    {
        $parent = Parents::findOne(['ParentId' => $id]);
        $kids = Children::find()->where(['ParentId' => $id]);
        $kidsProvider = new ActiveDataProvider([
            'query' => $kids,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $this->render('index', [
            'model' => $parent,
            'kids' => $kidsProvider,
        ]);
    }

    public function actionUpdate()
    {
        return $this->render('update');
    }

}
