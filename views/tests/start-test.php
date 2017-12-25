<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 25.12.2017
 * Time: 16:13
 */

use yii\helpers\Html;

$this->title = Yii::t('app', 'Rozpocznij test');
/* @var $this yii\web\View */
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            <p><?= $difficulty->Name. ' - ' . $category->Name ?></p>
        </div>
    </div>
    <div class="panel-body">
        <?php $form = \yii\bootstrap\ActiveForm::begin();?>
        <?= $form->field($model, 'child')->widget(\kartik\select2\Select2::className(), [
                'data' => $kids,
                'language' => 'pl',
                'hideSearch' => true,
        ])->label(Yii::t('app', 'Wybierz dziecko'))?>

        <?= Html::submitButton('<i class="fa fa-pencil-square-o" aria-hidden="true"></i> ' .  Yii::t('app', 'Rozpocznij test'),
            [
                    'class' => 'btn btn-primary btn-block',
                    'name' => 'start-test',
                    'data-confirm' => Yii::t('app', 'Czy na pewno chcesz rozpocząć rozwiązywanie testu?'),
            ]) ?>
<?php \yii\bootstrap\ActiveForm::end()?>
    </div>
</div>