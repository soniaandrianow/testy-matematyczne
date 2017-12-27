<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 27.12.2017
 * Time: 12:45
 */
use yii\helpers\Html;
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <p class="test-heading center"><?=Html::a($model->difficulty->Name . ' - ' . $model->category->Name, ['view-test/display', 'id' => $model->TestId])?></p>
    </div>
    <div class="panel-body">
        <table class="responsible" width="100%">
            <tr>
                <td><p><?=Yii::t('app', 'Rozwiązujący:')?></p></td>
                <td><p><?=$model->child->fullname?></p></td>
            </tr>
            <tr>
                <td><p><?=Yii::t('app', 'Data rozwiązania:')?></p></td>
                <td><p><?=$model->GeneratedDate?></p></td>
            </tr>
        </table>

    </div>
</div>
