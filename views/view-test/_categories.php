<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 27.12.2017
 * Time: 10:42
 */

use yii\helpers\Html;

?>
<?php if($main_cat) : ?>
    <div class="panel panel-primary">
        <div class="panel-body">
            <h5 class=" center info-label"><?=Yii::t('app', 'Wybierz kategorię testu')?></h5>
                    <?php foreach ($main_cat as $cat) : ?>
                        <div class="row" style="margin-bottom: 5px">
                         <?=Html::a($cat, null, ['id' => $cat, 'class' => 'btn btn-primary btn-block']);?>
                        </div>
                    <?php endforeach;?>
        </div>
    </div>
<?php else : ?>
<div class="panel panel-primary">
    <div class="panel-body">
        <?= Yii::t('app', 'Brak testów o wybranym poziomie trudności.')?>
    </div>
    <?php endif;?>
