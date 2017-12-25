<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 25.12.2017
 * Time: 18:07
 */

use yii\bootstrap\Progress;
use yii\helpers\Html;
use app\models\Answers;
use yii\helpers\Url;

$urlFirst = Url::to(['tests/first-question'], true);
$urlAnswer = Url::to(['tests/answer-question'], true);
$urlNext = Url::to(['tests/next-question'], true);
$urlPrevious = Url::to(['tests/previous-question'], true);
$questionId = Yii::$app->session['question_id'];

$js1 = <<<JS
$(document).ready(function(){
    console.log("TUTAJ");
    if("$questionId" == "0"){
        firstQuestion();
    }
    });

var firstQuestion = function() {
        console.log("Pierwsze pytanie");
        
        $.get(
            "$urlFirst",
            {
            },
            function(data){
                $("#reload").html(data)
            }
        )
    }; 
JS;

$js2 = <<<JS
var answer = function(elem) {
       console.log("Kolejne pytanie");
        
        $.get(
            "$urlAnswer",
            {
                "id": $(elem).attr("id"),
            },
            function(data){
                $("#reload").html(data)
            }
        )
    }; 

var previous = function(elem) {
        console.log("Poprzednie pytanie");
        
        $.get(
            "$urlPrevious",
            {
            },
            function(data){
                $("#reload").html(data)
            }
        )
    }; 

var next = function(elem) {
        console.log("Kolejne pytanie");
        
        $.get(
            "$urlNext",
            {
            },
            function(data){
                $("#reload").html(data)
            }
        )
    }; 
JS;

$this->registerJS($js1);
$this->registerJS($js2, \yii\web\View::POS_BEGIN);
?>

<div class="panel panel-primary">
    <div class="panel-heading" style="text-align: center">
        <div class="panel-title">
            <h3><?= Yii::$app->session['testForm']->difficulty->Name . ' - ' . Yii::$app->session['testForm']->category->Name ?></h3>
        </div>
    </div>
    <div class="panel-body">

        <div id="reload">

        </div>

    </div>
</div>

