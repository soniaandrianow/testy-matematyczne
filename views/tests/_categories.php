<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 25.12.2017
 * Time: 15:39
 */

use yii\helpers\Html;
use yii\helpers\Url;

?>

<?php if($categories) : ?>
<div class="panel panel-primary">
    <div class="panel-body">
        <h5 class="info-label"><?php//=Yii::t('app', 'Wybierz kategorię testu')?></h5>
        <?php foreach($main_cat as $main) : ?>
            <h4><?=$main?></h4>
        <ul>
            <?php foreach ($categories as $cat) : ?>
                <?php if($cat->MainCategory == $main) : ?>
                <li><?=Html::a($cat->Name, ['tests/create-test' , 'category_id' => $cat->CategoryId, 'difficulty_id' => $difficulty], ['id' => $cat->CategoryId]);?></li>
                    <?php endif; ?>
            <?php endforeach;?>
        </ul>
        <?php endforeach;?>
    </div>
</div>
 <?php else : ?>
<div class="panel panel-primary">
    <div class="panel-body">
        <?= Yii::t('app', 'Brak testów o wybranym poziomie trudności.')?>
    </div>
<?php endif;?>

