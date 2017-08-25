<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\widgets\Breadcrumbs;
use yii\widgets\Spaceless;
use frontend\assets\AppAsset;
use common\models\Node;
use yiichina\adminlte\Alert;
use yiichina\adminlte\NavBar;
use yiichina\icons\Icon;
use yii\widgets\Menu;

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
<?php Spaceless::begin(); ?>
<div class="wrapper">
    <header class="main-header">
        <?php
        if(Yii::$app->user->isGuest) {
            $userItems = [
                [
                    'label' => Icon::show('sign-in') . Yii::t('app', 'Login'),
                    'url' => ['site/login'],
                ],
                [
                    'label' => Icon::show('user-plus') . Yii::t('app', 'Signup'),
                    'url' => ['site/signup'],
                ]
            ];
        } else {
            $userItems = [
                [
                    'label' => Icon::show('envelope-o') . Html::tag('span', 4, ['class' => 'label label-success']),
                    'url' => '#',
                    'options' => ['class' => 'messages-menu'],
                    'items' => [
                        Html::tag('li', '您有 4 条消息', ['class' => 'header']),
                        Html::tag('li', Menu::widget([
                            'options' => ['class' => 'menu'],
                            'items' => [
                                ['label' => 'Home', 'url' => ['site/index']],
                                ['label' => 'Home', 'url' => ['site/index']],
                            ],
                        ])),
                        Html::tag('li', Html::a('查看更多信息', '#'), ['class' => 'footer']),
                    ],
                ],
                [
                    'label' => Icon::show('bell-o') . Html::tag('span', 10, ['class' => 'label label-warning']),
                    'url' => '#',
                    'options' => ['class' => 'notifications-menu'],
                    'items' => [
                        Html::tag('li', '您有 10 条通知', ['class' => 'header']),
                        Html::tag('li', Menu::widget([
                            'options' => ['class' => 'menu'],
                            'items' => [
                                ['label' => 'Home', 'url' => ['site/index']],
                                ['label' => 'Home', 'url' => ['site/index']],
                            ],
                        ])),
                        Html::tag('li', Html::a('查看更多通知', '#'), ['class' => 'footer']),
                    ],
                ],
                [
                    'label' => Icon::show('flag-o') . Html::tag('span', 9, ['class' => 'label label-danger']),
                    'url' => '#',
                    'options' => ['class' => 'tasks-menu'],
                    'items' => [
                        Html::tag('li', '您有 4 个任务', ['class' => 'header']),
                        Html::tag('li', Menu::widget([
                            'options' => ['class' => 'menu'],
                            'items' => [
                                ['label' => 'Home', 'url' => ['site/index']],
                                ['label' => 'Home', 'url' => ['site/index']],
                            ],
                        ])),
                        Html::tag('li', Html::a('查看更多任务', '#'), ['class' => 'footer']),
                    ],
                ],
                [
                    'label' => Html::img('http://www.yiichina.com/uploads/avatar/000/00/00/02_avatar_small.jpg', ['alt' => Yii::$app->user->identity->username, 'class' => 'user-image']) . Html::tag('span', Yii::$app->user->identity->username, ['class' => 'hidden-xs']),
                    'url' => '#',
                    'options' => ['class' => 'user user-menu'],
                    'items' => [
                        Html::tag('li', '您有 4 个任务', ['class' => 'user-header']),
                        Html::tag('li', '您有 4 个任务', ['class' => 'user-body']),
                        Html::tag('li', Html::tag('div',Html::a('Profile', ['/user'], ['class' => 'btn btn-default btn-flat']), ['class' => 'pull-left']) . Html::tag('div', Html::a(Yii::t('app', 'Sign out'), ['site/logout'], ['class' => 'btn btn-default btn-flat', 'data' => ['method' => 'post']]), ['class' => 'pull-right']), ['class' => 'user-footer']),
                    ],
                ],
            ];
        }
        NavBar::begin([
            'brandLabel' => Html::img('@web/images/logo.png', ['alt' => 'Yii CMS']) . 'Yii CMS',
            'brandUrl' => Yii::$app->homeUrl,
            'screenReaderToggleText' => Icon::show('bars'),
            'containerOptions' => ['class' => 'pull-left'],
            'options' => [
                'class' => 'navbar-static-top',
            ],
            'customMenu' => Nav::widget([
                'options' => ['class' => 'navbar-nav'],
                'items' => $userItems,
                'encodeLabels' => false,
            ]),
        ]);
        $menuItems = array_merge([
            ['label' => Icon::show('home') . '首页', 'url' => ['/site/index']],
            ['label' => Icon::show('calendar') . '动态', 'url' => ['/template/index']],
            ['label' => Icon::show('book') . '文档', 'url' => ['/site/timeline']],
            ['label' => Icon::show('question-circle-o') . '常见问题', 'url' => ['/site/timeline']],
            ['label' => Icon::show('files-o') . '模板', 'url' => ['/site/timeline']],
            ['label' => Icon::show('cubes') . '插件', 'url' => ['/site/timeline']],
            ['label' => Icon::show('users') . '社区', 'url' => ['/site/timeline']],

            ['label' => Icon::show('clock-o') . '时间线', 'url' => ['/site/timeline']],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav'],
            'items' => $menuItems,
            'encodeLabels' => false,
        ]);
        NavBar::end();
        ?>
    </header>

    <div class="content-wrapper">
        <div class="container">
            <?php if(isset($this->params['mainTitle']) || isset($this->params['breadcrumbs'])): ?>
            <section class="content-header">
                <?php if(isset($this->params['mainTitle'])): ?>
                    <?= Html::tag('h1', $this->params['mainTitle'] . (empty($this->params['subTitle']) ? null : Html::tag('small', $this->params['subTitle']))) ?>
                <?php endif; ?>
                <?= Breadcrumbs::widget([
                    'homeLink' => [
                        'label' => Icon::show('home') . '首页',
                        'encode' => false,
                        'url' => Yii::$app->homeUrl
                    ],
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
            </section>
            <?php endif; ?>
            <section class="content">
                <?= Alert::widget() ?>
                <?= $content ?>
            </section>
        </div>
    </div>

    <footer class="main-footer">
        <div class="container">
            <div class="pull-right hidden-xs">
                <b>Yii CMS Version</b> 2.4.0 - <?= Yii::powered() ?> - <a href="http://www.miibeian.gov.cn" target="_blank">京ICP备09104811号</a>
            </div>
            <strong>Copyright &copy; 2009-<?= date('Y') ?> <a href="http://www.yiichina.com">Yii China</a>.</strong> All rights reserved.
        </div>
    </footer>
</div>
<?php Spaceless::end(); ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
