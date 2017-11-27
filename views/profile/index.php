<?php


use yii\helpers\Url;

$this->title = Yii::t('app', 'Profil');
/* @var $this yii\web\View */
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            <p><?= Yii::t('app', 'Dane konta') ?></p>
        </div>
    </div>
    <div class="panel-body">
        <?= \yii\widgets\DetailView::widget([
            'model' => $model,
            'attributes' => [
                'FirstName',
                'LastName',
                'PhoneNumber',
                'EmailAddress'
            ]
        ]) ?>
        <div class="row" style="width:100%; margin: 0px;">
            <?= \yii\helpers\Html::a(Yii::t('app', 'Edytuj dane'), Url::to(['profile/edit', 'id' => $model->ParentId]), ['class' => 'btn btn-primary pull-left']); ?>
            <?= \yii\helpers\Html::a(Yii::t('app', 'Zmień hasło'), Url::to(['profile/change-password', 'id' => $model->ParentId]), ['class' => 'btn btn-primary pull-right ']); ?>
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            <p><?= Yii::t('app', 'Dzieci') ?></p>
        </div>
    </div>
    <div class="panel-body">
        <div class="row" style="width:100%; margin-bottom: 10px">
            <?= \yii\helpers\Html::a(Yii::t('app', 'Dodaj dziecko'), Url::to(['children/add', 'id' => $model->ParentId]), ['class' => 'btn btn-primary pull-right']); ?>
        </div>
        <div>
            <?= \yii\grid\GridView::widget([
                'dataProvider' => $kids,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'fullname',
                    [
                        'label' => Yii::t('app', 'Wiek'),
                        'value' => function ($data) {
                            return date('Y', strtotime('now')) - date('Y', $data->DateOfBirth);
                        }
                    ],
                    ['class' => 'yii\grid\ActionColumn'],

                ]
            ]); ?>
        </div>
    </div>
</div>

