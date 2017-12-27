<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 27.12.2017
 * Time: 15:40
 */

use yii\helpers\Html;

?>

<div id="panel-question-preview" class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            <h4><?= Yii::t('app', 'Zadanie ') . $number ?></h4>
        </div>
    </div>
    <div class="panel-body" style="text-align: center">
        <div class="content">
            <?= $task->Content ?>
        </div>
        <?php
        $taskans = \app\models\TaskAnswers::find()->where(['TaskId' => $task->TaskId])->all();
        //var_dump($taskans); die;
        $answers = [];
        foreach ($taskans as $ta) {
            $answers[] = $ta->answer;
        }
        $row = 2;
        $col = 2;
        $answ = 0;
        //var_dump($answers); die;
        ?>
        <div class="answers-preview" >

            <?php for ($i = 0; $i < $row; $i++) : ?>
                <div class="row" style="margin-top: 10px;">
                    <?php for ($j = 0; $j < $col; $j++): ?>
                        <div class="col-md-6">
                            <p class="btn-block btn-answer-<?= $answers[$answ]->isCorrect() ? 'green' : ($answers[$answ]->AnswerId  == $chosen ? 'red' : 'clear') ?>"><?=$answers[$answ]->Content?></p>
                            <?php $answ++; ?>
                        </div>
                    <?php endfor; ?>
                </div>
            <?php endfor; ?>

        </div>
    </div>
</div>
