<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 27.11.2017
 * Time: 16:28
 */

use borales\extensions\phoneInput\PhoneInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = Yii::t('app', 'Zarejestruj się');
?>

<div class="col-md-8 col-md-offset-1">
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            <h3><?=Yii::t('app', 'Zarejestruj się')?></h3>
        </div>
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin([])?>
        <?=$form->field($model, 'email')->textInput();?>
        <?=$form->field($model, 'firstname')->textInput();?>
        <?=$form->field($model, 'lastname')->textInput();?>
        <?=$form->field($model, 'phone_number')->widget(PhoneInput::className(), [
            'options' => ['class' => 'form-control'],
            'jsOptions' => [
                'preferredCountries' => ['pl'],
                'nationalMode' => false
            ],
        ])->label(Yii::t('app', 'Telefon'), ['style' => 'display:inherit;']);?>
        <?=$form->field($model, 'password')->passwordInput();?>
        <?=$form->field($model, 'password_repeat')->passwordInput();?>
        <?= Html::submitButton(Yii::t('app', 'Zarejestruj się'), ['class' => 'btn btn-primary btn-block', 'name' => 'signup']) ?>
        <br>
        <span class="pull-left"><?= Html::a(Yii::t('app', 'Masz już konto? Zaloguj się!'), ['site/login']) ?></span>
        <?php $form::end()?>
    </div>
</div>
</div>