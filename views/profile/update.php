<?php
/* @var $this yii\web\View */

use borales\extensions\phoneInput\PhoneInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Aktualizuj profil');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profil'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            <p><?=Yii::t('app', 'Aktualizuj profil')?></p>
        </div>
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin([])?>
        <?=$form->field($model, 'FirstName')->textInput();?>
        <?=$form->field($model, 'LastName')->textInput();?>
        <?=$form->field($model, 'PhoneNumber')->widget(PhoneInput::className(), [
            'options' => ['class' => 'form-control'],
            'jsOptions' => [
                'preferredCountries' => ['pl'],
                'nationalMode' => false
            ],
        ])->label(Yii::t('app', 'Telefon'), ['style' => 'display:inherit;']);?>
        <?=$form->field($model, 'EmailAddress')->textInput();?>
        <?= Html::submitButton(Yii::t('app', 'Zapisz'), ['class' => 'btn btn-primary btn-block', 'name' => 'add-kid']) ?>
        <?php $form::end()?>
    </div>
</div>