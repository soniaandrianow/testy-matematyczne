<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 27.12.2017
 * Time: 14:16
 */

use yii\widgets\ListView;

?>

<?= ListView::widget([
    'dataProvider' => $testsProvider,
    'itemView' => '_test-view',
    'summary' => false,
]);
?>
