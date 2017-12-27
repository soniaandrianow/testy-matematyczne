<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Children */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="children-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'FirstName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LastName')->textInput(['maxlength' => true]) ?>

    <?=$form->field($model, 'DateOfBirth')->widget(DatePicker::className(), [
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd'
        ]
    ]);?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Zapisz'), ['class' => 'btn btn-success btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
