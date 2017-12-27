<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 27.12.2017
 * Time: 12:44
 */

use kartik\select2\Select2;
use yii\widgets\ListView;
use yii\widgets\Pjax;
$js = <<<JS
$(document).ready(function(){
    if($("#kids-select").val() == ""){
    } else {
        reloadResults();
    }
    });
JS;
$this->registerJS($js);
?>
<?php Pjax::begin();?>
<?= Select2::widget([
    'value' => 0,
    'name' => 'time_range_select',
    'data' => $kidsSelect,
    'theme' => Select2::THEME_BOOTSTRAP,
    'hideSearch' => true,
    'pluginOptions' => [
        'allowClear' => false
    ],
    'options' => [
        //'placeholder' => Yii::t('app', 'select.time_range'),
        'class' => 'pjax-reload',
        'id' => 'kids_select',
        'difficulty' => $difficulty,
        'category' => $category
    ],
    'pluginEvents' => [
        "select2:close" => "function() { reloadResults()}",
    ]
]);?>
<div id='list' style="margin-top: 10px">

</div>
<?php Pjax::end()?>


