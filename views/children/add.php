<?php
/* @var $this yii\web\View */

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Dodaj dziecko');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profil'), 'url' => ['profile/index']];
$this->params['breadcrumbs'][] = $this->title;
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
            <?=$form->field($kid, 'DateOfBirth')->widget(DatePicker::className(), [
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd'
                     ]
        ]);?>
        <?= Html::submitButton(Yii::t('app', 'Zapisz'), ['class' => 'btn btn-primary btn-block', 'name' => 'add-kid']) ?>
        <?php $form::end()?>
    </div>
</div>

