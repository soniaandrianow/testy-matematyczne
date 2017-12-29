<?php

/* @var $this yii\web\View */

use kartik\tabs\TabsX;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Przeglądaj rozwiązane testy');


$js = <<<JS
$('#tabs-diff').addClass('nav-pills');
$("a").removeClass('selected');
$("document").ready(function() {
setTimeout(function() {
$(".tabs-krajee").find("li.active a").click();
},10) 
});
        
JS;

$urlSearchResult = Url::to(['view-test/category'], true);
$urlList = Url::to(['view-test/list'], true);
$js2 = <<<JS
        
  var reload = function(elem) {
        console.log($(elem).attr("id"));
        $("a").removeClass('selected');
        $(elem).addClass('selected');
        $.get(
            "$urlSearchResult",
            {
                "cat": $(elem).attr("id"),
                "id": $(elem).attr("diff")
            },
            function(data){
                $("#tests").html(data)
            }
        )
    }; 
JS;

$js3 = <<<JS

var reloadResults = function() {
    if($("#kids_select").val() != ""){
        console.log($("#kids_select").val());
        $.get(
            "$urlList",
            {
                "kid": $("#kids_select").val(),
                "difficulty": $("#kids_select").attr('difficulty'),
                "category": $("#kids_select").attr('category')
            },
            function(data){
                $("#list").html(data)
            }
        )
    };
}       
JS;

$this->registerJS($js2, \yii\web\View::POS_BEGIN);
$this->registerJS($js);
$this->registerJs($js3, \yii\web\View::POS_BEGIN);

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            <h3><?= Yii::t('app', 'Wybierz test do przeglądania') ?></h3>
        </div>
    </div>
    <div class="panel-body">
        <h5 class="center info-label"><?= Yii::t('app', 'Wybierz poziom trudności testu') ?></h5>
        <div class="row">
            <?php
            $items = [];
            foreach($difficulties as $diff) {
                $items[] = [
                    'label' => $diff->Name,
                    'linkOptions' => ['data-url' => Url::to(['view-test/difficulty', 'id'=>$diff->DifficultyId])],
                ];
            }
            //            $items = [
            //                [
            //                    'label' => Yii::t('app', 'dash.alerts') . ' (24h)',
            //                    'linkOptions' => ['data-url' => Url::to(['site/alerts'])],
            //                    'headerOptions' => ['id'=>'red'],
            //                ],
            //                [
            //                    'label' => '<i class="fa fa-globe"></i> ' . Yii::t('app', 'dash.all'),
            //                    'linkOptions' => ['data-url' => Url::to(['site/all-devices'])],
            //                    'active' => true,
            //                    'headerOptions' => ['id'=>'blue'],
            //                ],
            //                [
            //                    'label' => '<i class="fa fa-cubes"></i> ' . Yii::t('app', 'dash.groups'),
            //                    'linkOptions' => ['data-url' => Url::to(['site/all-by-groups'])],
            //                    'headerOptions' => ['id'=>'blue'],
            //                ],
            //
            //            ];
            ?>
            <?=
            TabsX::widget([
                'items' => $items,
                'id' => 'tabs-diff',
                'position' => TabsX::POS_ABOVE,
                //'bordered' => true,
                'encodeLabels' => false,
                'align' => TabsX::ALIGN_CENTER,
                'linkOptions' => [
                    'data-enable-cache' => false
                ],
                'enableStickyTabs' => true,
            ]);
            ?>
        </div>

    </div>
</div>