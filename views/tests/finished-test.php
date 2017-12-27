<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 25.12.2017
 * Time: 22:00
 */

use yii\helpers\Html;
?>

<div class="panel panel-primary">
    <div class="panel-heading" style="text-align: center">
        <div class="panel-title">
            <h3><?= $testForm->difficulty->Name . ' - ' . $testForm->category->Name ?></h3>
        </div>
    </div>
    <div class="panel-body" style="text-align: center">
        <?php if ($points_gained > $points / 2) : ?>
            <p class="result-success"><?= Yii::t('app', 'Brawo! Uzyskany wynik to: ') . $points_gained . '/' . $points . ' punktów.'?></p>
            <div class="image-success">
                <i class="fa fa-5x fa-trophy" aria-hidden="true"></i>
            </div>
        <?php else : ?>
            <p class="result-failure"><?= Yii::t('app', 'Ups! Uzyskany wynik to: ') . $points_gained . '/' . $points . ' punktów.'?></p>
            <div class="image-failure">
                <i class="fa fa-5x fa-frown-o" aria-hidden="true"></i>
            </div>
        <?php endif; ?>

        <?=Html::a(Yii::t('app', 'Zobacz odpowiedzi'), ['view-test/display', 'id' => $test->TestId], ['class' => 'btn btn-default']);?>
    </div>
</div>
