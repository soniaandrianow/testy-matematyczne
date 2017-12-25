<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 25.12.2017
 * Time: 17:51
 */

use app\models\Answers;
use yii\bootstrap\Progress;
use yii\helpers\Html;

?>

<div id="progress-bar">
    <?php
    $percents = 100 / Yii::$app->params['max_questions'];
    ?>
    <?= Progress::widget([
        'percent' => (Yii::$app->session['question_id'] + 1) * $percents,
        'barOptions' => ['class' => 'progress-bar-success'],
        //'label' => Yii::$app->session['question_id'] . '/10',
        'options' => ['class' => 'progress-striped']
    ]); ?>
</div>

<div class="col-md-8">
    <div id="panel-question" class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <h4><?= Yii::t('app', 'Zadanie ') . (Yii::$app->session['question_id'] + 1) ?></h4>
            </div>
        </div>
        <div class="panel-body" style="text-align: center">
            <div class="content">
                <?= Yii::$app->session['testForm']->tasks[Yii::$app->session['question_id']]->Content ?>
            </div>
            <?php
            $taskans = \app\models\TaskAnswers::find()->where(['TaskId' => Yii::$app->session['testForm']->tasks[Yii::$app->session['question_id']]->TaskId])->all();
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
            <div class="answers">

                <?php for ($i = 0; $i < $row; $i++) : ?>
                    <div class="row" style="margin-top: 10px;">
                        <?php for ($j = 0; $j < $col; $j++): ?>
                            <div class="col-md-6">
                                <?= Html::a($answers[$answ]->Content, null, ['class' => 'btn btn-primary answer btn-block', 'id' => $answers[$answ]->AnswerId, 'onclick' => 'answer(this)']) ?>
                                <?php $answ++; ?>
                            </div>
                        <?php endfor; ?>
                    </div>
                <?php endfor; ?>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2 col-md-offset-4">
            <?= Yii::$app->session['question_id'] == '0' ? '' : Html::a('<i class="fa fa-4x fa-arrow-left" aria-hidden="true"></i>', null, ['id' => 'left-arrow', 'title' => 'Poprzednie pytanie', 'onclick' => 'previous()']); ?>
        </div>
        <div class="col-md-2">
            <?= Yii::$app->session['question_id'] == (Yii::$app->params['max_questions'] - 1) ? '' : Html::a('<i class="fa fa-4x fa-arrow-right" aria-hidden="true"></i>', null, ['id' => 'right-arrow', 'title' => 'Kolejne pytanie', 'onclick' => 'next()']); ?>
        </div>
    </div>

</div>

<div class="col-md-4">
    <div id="your-answers" class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <h4><?= Yii::t('app', 'Twoje odpowiedzi'); ?></h4>
            </div>
        </div>
        <div class="panel-body" style="height: 250px; overflow-y: scroll">
            <ol>
                <?php foreach (Yii::$app->session['your_answers'] as $key => $answer): ?>
                    <?php if ($answer) : ?>
                        <li><?= $answer['answer'] ? Answers::findOne($answer['answer'])->Content : ' '; ?></li>
                        <hr>
                    <?php else : ?>
                        <li><?= ' ' ?></li>
                        <hr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ol>

        </div>
    </div>
    <?= Html::a('<i class="fa fa-check-square-o" aria-hidden="true"></i> ' . Yii::t('app', 'Zakończ test'), ['tests/finish-test'], [
        'class' => 'btn btn-success btn-block',
        'data-confirm' => Yii::t('app', 'Czy na pewno chcesz zakończyć rozwiązywanie testu?'),
        'style' => 'font-size: 150%;'
    ]); ?>
</div>

