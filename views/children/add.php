<?php
/* @var $this yii\web\View */

use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Dodaj dziecko');
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            <p><?=Yii::t('app', 'Dodaj dziecko')?></p>
        </div>
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin([])?>
            <?=$form->field($kid, 'FirstName')->textInput();?>
            <?=$form->field($kid, 'LastName')->textInput();?>
            <?=$form->field($kid, 'DateOfBirth')->;?>
        <?php $form::end()?>
    </div>
</div>

