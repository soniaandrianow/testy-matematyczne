<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 27.12.2017
 * Time: 10:42
 */

use yii\helpers\Html;
use yii\helpers\Url;



?>

    <?php if ($main_cat) : ?>
    <div class="col-md-4">
        <div class="panel panel-primary">
            <div class="panel-body">
                <h5 class=" center info-label"><?= Yii::t('app', 'Wybierz kategorię testu') ?></h5>
                <?php
                $items = [];
                foreach ($main_cat as $cat) {
                    $items[] = [
                        'label' => $cat,
                        'linkOptions' => ['data-url' => Url::to(['view-test/category', 'cat' => $cat])],
                    ];
                }
                ?>
                <?php foreach ($main_cat as $cat) : ?>
                    <div class="row" style="margin-bottom: 5px">
                        <?= Html::a($cat, null, ['id' => $cat, 'diff' => $difficulty, 'class' => 'btn btn-primary btn-block', 'onclick' => 'reload(this)']); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
        <div class="col-md-8">
            <div id="tests">

            </div>
        </div>
        <?php else : ?>
        <div class="panel panel-primary">
            <div class="panel-body">
                <?= Yii::t('app', 'Brak testów o wybranym poziomie trudności.') ?>
            </div>
            <?php endif; ?>
        </div>
    </div>


