<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Testy Matematyczne');


$urlSearchResult = Url::to(['tests/difficulty'], true);
$js = <<<JS
        
  var reload = function(elem) {
        console.log($(elem).attr("data"));
        $.get(
            "$urlSearchResult",
            {
                "id": $(elem).attr("data"),
            },
            function(data){
                $("#results").html(data)
            }
        )
    }; 
JS;
$this->registerJS($js, \yii\web\View::POS_BEGIN);

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            <p><?= Yii::t('app', 'Wybierz test') ?></p>
        </div>
    </div>
    <div class="panel-body">
        <?php foreach ($difficulties as $diff) : ?>
            <?=Html::a($diff->Name, null, ['class' => 'btn btn-primary btn-diff', 'id' => 'diff' . $diff->DifficultyId, 'data' => $diff->DifficultyId, 'onclick'=>'reload(this);']);?>
        <?php endforeach;?>

        <div id="results" style="margin-top: 10px">

        </div>
    </div>
</div>
