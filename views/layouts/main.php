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
                    <a class="navbar-brand navbar-right" href="#"><?=Yii::$app->name?></a>
                </div>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#zsxnavcollapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- <a class="navbar-brand" href="#top">TheBombHome</a> -->
            </div>
            <div class="collapse navbar-collapse navbar-right" id="zsxnavcollapse">
                <ul class="nav navbar-nav">
                    <?php if (Yii::$app->user->isGuest) : ?>
                        <li><?= Html::a('<i class="fa fa-lg fa-sign-in"></i> ' . Yii::t('app', 'Zaloguj się'), ['/site/login']) ?></a></li>
                        <li><?= Html::a('<i class=" fa fa-lg fa-user-plus"></i> ' . Yii::t('app', 'Zarejestruj się'), ['/site/signup']) ?></li>
                    <?php else : ?>
                        <li><?=
                            Html::a('<i class="fa fa-lg fa-user"></i> ' . Yii::t('app', 'Moje konto') . ' <b class="caret"></b>', ['#'], ['class' => 'dropdown-toggle', 'data-toggle' => 'dropdown']);
                            ?>
                            <?php
                            $menuItems[] = ['label' => '<i class="fa fa-lg fa-user"></i> ' . Yii::t('app', 'Profil'), 'url' => ['profile/index', 'id' => Yii::$app->user->id]];
                            $menuItems[] = '<li class="divider"></li>';
                            $menuItems[] = '<li>'
                                . Html::beginForm(['/site/logout'], 'post')
                                . Html::submitButton(
                                    '<i class="fa fa-lg fa-power-off"></i> ' . 'Wyloguj (' . Yii::$app->user->identity->FirstName . ')', ['class' => 'btn btn-link logout']
                                )
                                . Html::endForm()
                                . '</li>';
                            ?>
                            <?=
                            Dropdown::widget([
                                'items' => $menuItems,
                                'encodeLabels' => false,
                                'id' => 'dropdown-menu'
                            ])
                            ?>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container">

        <div class="col-md-2">
            <?= $this->render('_side-nav.php') ?>
        </div>
        <div class="col-md-9 col-md-offset-1">
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
