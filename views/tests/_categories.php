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
        <ul>
            <?php foreach ($categories as $cat) : ?>
                <li><?=Html::a($cat->Name, ['tests/create-test' , 'category_id' => $cat->CategoryId, 'difficulty_id' => $difficulty], ['id' => $cat->CategoryId]);?></li>
            <?php endforeach;?>
        </ul>
    </div>
</div>
 <?php else : ?>
<div class="panel panel-primary">
    <div class="panel-body">
        <?= Yii::t('app', 'Brak testów o wybranym poziomie.')?>
    </div>
<?php endif;?>

