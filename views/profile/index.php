<?php


use yii\helpers\Url;

$this->title = Yii::t('app', 'Profil');
/* @var $this yii\web\View */

$this->params['breadcrumbs'][] = $this->title;
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
            <?= \yii\helpers\Html::a(Yii::t('app', 'Edytuj dane'), Url::to(['profile/update']), ['class' => 'btn btn-primary pull-left']); ?>
            <?= \yii\helpers\Html::a(Yii::t('app', 'Zmień hasło'), Url::to(['profile/change-password']), ['class' => 'btn btn-primary pull-right ']); ?>
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
            <?= \yii\helpers\Html::a(Yii::t('app', 'Dodaj dziecko'), Url::to(['children/add']), ['class' => 'btn btn-primary pull-right']); ?>
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
                            return date('Y', strtotime('now')) - date('Y', strtotime($data->DateOfBirth));
                        }
                    ],
                    'pointsSummary',
                    [
                            'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {update} {delete}',
                        'urlCreator' => function ($action, $model, $key, $index) {
                            if ($action === 'view') {
                                $url = Url::to(['children/view', 'id' => $model->ChildId]);
                                return $url;
                            }if ($action === 'update') {
                                $url = Url::to(['children/update', 'id' => $model->ChildId]);
                                return $url;
                            }
                            if ($action === 'delete') {
                                $url = Url::to(['children/delete', 'id' => $model->ChildId]);
                                return $url;
                            }
                        }
                    ],

                ]
            ]); ?>
        </div>
    </div>
</div>

