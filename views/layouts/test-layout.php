<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\bootstrap\Dropdown;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <!--    --><?php
        //    NavBar::begin([
        //        'brandLabel' => Yii::$app->name,
        //        'brandUrl' => Yii::$app->homeUrl,
        //        'options' => [
        //            'class' => 'navbar-inverse navbar-fixed-top',
        //        ],
        //    ]);
        //    echo Nav::widget([
        //        'options' => ['class' => 'navbar-nav navbar-right'],
        //        'items' => [
        //            Yii::$app->user->isGuest ? ' ' :
        //            ['label' => Yii::t('app', 'Moje konto'), 'url' => ['/site/index']],
        //            Yii::$app->user->isGuest ? (
        //                ['label' => 'Login', 'url' => ['/site/login']]
        //            ) : (
        //                '<li>'
        //                . Html::beginForm(['/site/logout'], 'post')
        //                . Html::submitButton(
        //                    'Logout (' . Yii::$app->user->identity->username . ')',
        //                    ['class' => 'btn btn-link logout']
        //                )
        //                . Html::endForm()
        //                . '</li>'
        //            )
        //        ],
        //    ]);
        //    NavBar::end();
        //    ?>

        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <div class="navbar-header">
                        <p class="navbar-brand navbar-right"><?=Yii::$app->name?></p>
                    </div>
                </div>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                            <li><?= Html::a('<i class="fa fa-times" aria-hidden="true"></i> ' . Yii::t('app', 'Anuluj test'), ['/tests/cancel'], [
                                    'class' => 'btn btn-danger',
                                    'style' => 'margin-top: 5px; color: white',
                                    'data-confirm' => Yii::t('app', 'Czy na pewno chcesz anulować rozwiązywanie testu?'),
                                ]) ?></a></li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="container">

                <div class="row">
                    <div>
                        <?= Alert::widget(); ?>
                    </div>
                </div>
                <div class="row">
                    <?= $content ?>
                </div>

        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="text-center">&copy; ICK <?= date('Y') ?></p>

        </div>
    </footer>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>