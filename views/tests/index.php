<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 25.12.2017
 * Time: 14:49
 */

use yii\helpers\Html;


$this->title = Yii::t('app', 'Wybierz test');
/* @var $this yii\web\View */
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            <p><?= Yii::t('app', 'Wybierz test') ?></p>
        </div>
    </div>
    <div class="panel-body">
        <?php foreach ($difficulties as $diff) : ?>
            <?=Html::a($diff->name, null, ['class' => 'btn btn-primary btn-diff']);?>
        <?php endforeach;?>
    </div>
</div>
