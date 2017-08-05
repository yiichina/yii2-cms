<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\models\Node;
use common\widgets\Alert;

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
<body class="hold-transition skin-blue layout-top-nav">
<?php $this->beginBody() ?>

<div class="wrapper">
    <header class="main-header">
        <?php
        NavBar::begin([
            'brandLabel' => Html::img('@web/images/logo.png', ['alt' => 'Yii CMS']) . 'Yii CMS',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-static-top',
            ],
        ]);
        $menuItems = array_merge([['label' => '首页', 'url' => ['/site/index']]], Node::getMenuItems());
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => '注册', 'url' => ['/site/signup']];
            $menuItems[] = ['label' => '登录', 'url' => ['/site/login']];
        } else {
            $menuItems[] = '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>';
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems,
            'encodeLabels' => false,
        ]);
        NavBar::end();
        ?>
    </header>

    <div class="content-wrapper">
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="main-footer">
        <div class="container">
            <div class="pull-right hidden-xs">
                <b>YiiCMS Version</b> 2.4.0 - <?= Yii::powered() ?> - <a href="http://www.miibeian.gov.cn" target="_blank">京ICP备09104811号</a>
            </div>
            <strong>Copyright &copy; 2009-<?= date('Y') ?> <a href="http://www.yiichina.com">Yii China</a>.</strong> All rights
            reserved.
        </div>
    </footer>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
