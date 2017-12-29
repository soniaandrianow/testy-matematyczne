<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 27.12.2017
 * Time: 10:53
 */


use kartik\tabs\TabsX;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Testy Matematyczne');


$js = <<<JS
$('#w0').addClass('nav-pills');
$("document").ready(function() {
setTimeout(function() {
$(".tabs-krajee").find("li.active a").click();
},10) 
});
        
JS;

$this->registerJS($js);

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            <h3><?= Yii::t('app', 'Wybierz test') ?></h3>
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
                    'linkOptions' => ['data-url' => Url::to(['tests/difficulty', 'id'=>$diff->DifficultyId])],
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
                'position' => TabsX::POS_ABOVE,
                'bordered' => true,
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

