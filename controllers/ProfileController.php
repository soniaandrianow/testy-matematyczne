<?php

namespace app\controllers;

use app\models\Children;
use app\models\Parents;
use yii\data\ActiveDataProvider;
use Yii;
use app\components\Controller;
use app\models\forms\PasswordForm;

class ProfileController extends Controller
{
    public function actionIndex()
    {
        $id = Yii::$app->user->id;
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
        $id = Yii::$app->user->id;
        $parent = Parents::findOne(['ParentId' => $id]);
        if($parent->load(Yii::$app->request->post())) {
            if($parent->save()) {
                $this->ok('Pomyślnie zaktualizowano dane profilowe.');
                return $this->redirect(['profile/index']);
            }
            $this->err('Wystąpił niespodziewany błąd podczas aktualizacji danych. Spróbuj ponownie póżniej.');
            return $this->redirect(['profile/index']);
        }
        return $this->render('update', [
            'model' => $parent
        ]);
    }

    public function actionChangePassword()
    {
        $id = Yii::$app->user->id;
        $parent = Parents::findOne((['ParentId' => $id]));
        $form = new PasswordForm();
        if($form->load(Yii::$app->request->post())) {
            if($form->validate()) {
                $parent->Password = $form->new_password;
                if($parent->save()) {
                    $this->ok('Hasło zostało pomyślnie zaktualizowane.');
                    return $this->redirect(['profile/index']);
                }
                $this->err('Wystąpił niespodziewany błąd podczas zmiany hasła. Spróbuj ponownie póżniej.');
                return $this->redirect(['profile/index']);
            }
        }
        return $this->render('change-password', [
            'model' => $form
        ]);
    }

}
