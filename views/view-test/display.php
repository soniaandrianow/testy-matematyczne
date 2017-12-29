<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 27.12.2017
 * Time: 14:44
 */

use yii\helpers\Html;
use yii\helpers\Url;


$urlAnswer = Url::to(['view-test/answer'], true);
$js = <<<JS
        
  var loadAnswer = function(elem) {
        console.log($(elem).attr("id"));
        $.get(
            "$urlAnswer",
            {
                "test": $(elem).attr("data"),
                "task": $(elem).attr("id"),
                "number": $(elem).attr("number"),
                "chosen": $(elem).attr("chosen")
            },
            function(data){
                $("#answer").html(data)
            }
        )
    }; 
JS;

$this->registerJs($js, \yii\web\View::POS_BEGIN);

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            <h3><?= $test->difficulty->Name . ' - ' . $test->category->Name ?></h3>
            <h4><?= $test->child->fullname . ' - ' . $test->GeneratedDate ?></h4>
        </div>
    </div>

    <div class="panel-body">
        <div class="col-md-7">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4><?= Yii::t('app', 'Wyniki') ?></h4>
                    </div>
                </div>
                <div class="panel-body">
                    <table width="100%">
                        <tr>
                            <td><h5><?= Yii::t('app', 'Poprawne rozwiązania: ') ?></h5></td>
                            <td><h5><?= count($goodSolutions) . '/' . count($solutions) ?></h5></td>
                        </tr>
                        <tr>
                            <td><h5><?= Yii::t('app', 'Uzyskana liczba punktów: ') ?></h5></td>
                            <td><h5><?= $pointsGained . '/' . $test->MaximumPoints ?></h5></td>
                        </tr>
                    </table>

                    <div class="panel panel-default">
                        <div class="panel-body" style="height: 250px; overflow-y: scroll">
                            <p>Wybierz interesujące Cię pytanie aby zobaczyć szczegóły</p>
                            <hr>
                            <?php $i = 1;
                            foreach ($solutions as $solution): ?>
                                <div class="row">
                                    <a style="cursor: pointer" id="<?= $solution->TaskId ?>"
                                       data="<?= $solution->TestId ?>" number="<?= $i ?>"
                                       chosen="<?= $solution->answer ? $solution->answer->AnswerId : ' - '?> " onclick="loadAnswer(this)">


                                        <div class="col-md-4">
                                            <p><?= Yii::t('app', 'Zadanie ') . $i . '.' ?></p>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="<?= $solution->isCorrect() ? 'green' : 'red' ?>"><?= $solution->answer ? $solution->answer->Content : ' - '?></p>
                                        </div>
                                    </a>
                                </div>
                                <hr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div id="answer">

            </div>
        </div>
    </div>
</div>
