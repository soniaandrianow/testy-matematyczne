<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Children */

$this->title = Yii::t('app', 'Aktualizuj dane: {nameAttribute}', [
    'nameAttribute' => $model->fullname,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profil'), 'url' => ['profile/index']];
$this->params['breadcrumbs'][] = ['label' => $model->fullname, 'url' => ['view', 'id' => $model->ChildId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Aktualizuj');
?>
<div class="children-update">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <h3><?= Html::encode($this->title) ?></h3>
            </div>
        </div>
        <div class="panel-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>
</div>
