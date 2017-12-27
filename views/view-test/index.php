<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Przeglądaj rozwiązane testy');


$urlSearchResult = Url::to(['view-test/difficulty'], true);
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
            <h3><?= Yii::t('app', 'Wybierz test do przeglądania') ?></h3>
        </div>
    </div>
    <div class="panel-body">
        <h5 class="center info-label"><?= Yii::t('app', 'Wybierz poziom trudności testu') ?></h5>
        <div class="row">
            <?php foreach ($difficulties as $diff) : ?>
                <div class="col-md-3">
                    <?= Html::a($diff->Name, null, ['class' => 'btn btn-primary btn-diff btn-block', 'id' => 'diff' . $diff->DifficultyId, 'data' => $diff->DifficultyId, 'onclick' => 'reload(this);']); ?>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div id="results" style="margin-top: 10px">

                </div>
            </div>
            <div class="col-md-6">
                <div id="tests" style="margin-top: 10px">

                </div>
            </div>
        </div>
    </div>
</div>