<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 27.11.2017
 * Time: 15:58
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Zmień hasło');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profil'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            <p><?=Yii::t('app', 'Zmień hasło')?></p>
        </div>
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin([])?>
        <?=$form->field($model, 'password')->passwordInput();?>
        <?=$form->field($model, 'new_password')->passwordInput();?>
        <?=$form->field($model, 'new_password_repeat')->passwordInput();?>
        <?= Html::submitButton(Yii::t('app', 'Zapisz'), ['class' => 'btn btn-primary btn-block', 'name' => 'change-password']) ?>
        <?php $form::end()?>
    </div>
</div>