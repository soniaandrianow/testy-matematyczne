<?php

namespace app\controllers;

use app\components\Controller;
use app\models\Children;
use Yii;

class ChildrenController extends Controller
{
    public function actionAdd($id)
    {
        $kid = new Children();
        $kid->ParentId = $id;
        if ($kid->load(Yii::$app->request->post())) {
            if($kid->save()) {
                $this->ok('Dodano nowe dziecko.');
                $this->redirect(['profile/index', 'id' => $id]);
            }
            $this->err('Nie udało się dodać dziecka.');
            $this->redirect(['profile/index', 'id' => $id]);
        }
        return $this->render('add', [
            'kid' => $kid,
        ]);
    }

}
