<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 29.12.2017
 * Time: 10:49
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = Yii::t('app', 'Zresetuj hasło');
?>


<div class="col-md-8 col-md-offset-1">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <h3><?=$this->title?></h3>
            </div>
        </div>
        <div class="panel-body">
            <p><?=Yii::t('app', 'Podaj adres email dla którego chcesz zresetować hasło.')?></p>
                    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                    <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
                    <div class="form-group">
                        <?= Html::submitButton('Wyślij', ['class' => 'btn btn-primary']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>