<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app' ,'Zaloguj się');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-8 col-md-offset-1">
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            <h3><?=$this->title?></h3>
        </div>
    </div>
    <div class="panel-body" style="text-align: center">
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'layout' => 'horizontal',
        ]); ?>

        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox([])->label(Yii::t('app','Zapamiętaj mnie'))?>

        <div class="form-group" style="padding-left: 5px; padding-right: 5px;">
                <?= Html::submitButton('Zaloguj się', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
            <br>
            <span class="pull-left"><?= Html::a(Yii::t('app', 'Zapomniałeś hasła?'), ['site/reset-password']) ?></span>
            <span class="pull-right"><?= Html::a(Yii::t('app', 'Zarejestruj się'), ['site/signup'])?></span>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
</div>
