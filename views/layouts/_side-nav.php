<?php


use kartik\sidenav\SideNav;

echo SideNav::widget([
'type' => SideNav::TYPE_DEFAULT,
'encodeLabels' => false,
'items' => [
[
'label' => '<i class="fa fa-lg fa-book"></i> ' . Yii::t('app', 'Wybierz test'),
'url' => ['site/index'],
],
[
'label' => '<i class="fa fa-lg fa-files-o"></i> ' . Yii::t('app', 'Rozwiązane testy'),
'url' => ['view-test/index'],
],
'headingOptions' => [
'class' => 'text-center',
],
]
]);
