<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Children */

$this->title = $model->fullname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profil'), 'url' => ['profile/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="children-view">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <h3><?= Html::encode($this->title) ?></h3>
            </div>
        </div>
        <div class="panel-body">
            <p>
                <?= Html::a(Yii::t('app', 'Edytuj dane'), ['update', 'id' => $model->ChildId], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Usuń'), ['delete', 'id' => $model->ChildId], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Na pewno chcesz usunąć wybrany element? Jest to akcja nieodwracalna.'),
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'FirstName',
                    'LastName',
                    [
                        'attribute' => 'formattedDate',
                        'label' => Yii::t('app', 'Data urodzenia'),
                    ],
                ],
            ]) ?>
        </div>
    </div>

</div>
