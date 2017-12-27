<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Children */

$this->title = Yii::t('app', 'Dodaj dziecko');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dzieci'), 'url' => ['profile/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="children-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
