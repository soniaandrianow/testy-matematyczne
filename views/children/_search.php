<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\SearchChildren */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="children-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'ChildId') ?>

    <?= $form->field($model, 'FirstName') ?>

    <?= $form->field($model, 'LastName') ?>

    <?= $form->field($model, 'DateOfBirth') ?>

    <?= $form->field($model, 'ParentId') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
