<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use backend\assets\AppAsset;
use yiichina\adminlte\NavBar;
use yiichina\adminlte\SideBar;
use yiichina\icons\Icon;
use yii\widgets\Breadcrumbs;
use common\models\Node;

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
<body class="hold-transition skin-blue sidebar-mini">
<?php $this->beginBody() ?>

<div class="wrapper">
    <!-- header -->
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('@web/images/logo.png', ['alt' => 'Yii CMS']) . 'Yii CMS',
        'brandLabelSm' => Html::img('@web/images/logo.png', ['alt' => 'Yii CMS']),
        'items' => [
            ['label'=>'', 'url' => '#', 'icon' => 'fa fa-dashboard'],
            [
                'label' => '栏目管理',
                'items'=>[
                    ['label'=>'child#2-1', 'url' => '#child2-1'],
                    ['label'=>'child#2-2', 'url' => '#child2-2']
                ]
            ],
            [
                'label' => '模板管理',
                'items'=>[
                    ['label'=>'child#2-1', 'url' => '#child2-1'],
                    ['label'=>'child#2-2', 'url' => '#child2-2']
                ]
            ],
            [
                'label' => '会员管理',
                'items'=>[
                    ['label'=>'child#3-1', 'url' => '#child3-1'],
                    ['label'=>'child#3-2', 'url' => '#child3-2']
                ]
            ],
        ],
    ]);
    NavBar::end();
    echo Sidebar::widget([
        'encodeLabels' => false,
        'items' => [
            [
                'label' => Icon::show('cogs', 'fa') . '工具区',
                'options' => ['class' =>'header'],
            ],
            [
                'label' => '仪表盘', 
                'url' => Yii::$app->homeUrl, 
                'icon' => 'fa fa-dashboard',
                'active' => Yii::$app->controller->id == 'site',
            ],
            [
                'label' => '栏目管理',
                'url' => ['node/index'],
                'icon' => 'fa fa-columns',
                'active' => Yii::$app->controller->id == 'node',
            ],
            [
                'label' => '模板管理',
                'url' => ['template/index'],
                'icon' => 'fa fa-file-code-o',
                'active' => Yii::$app->controller->id == 'template',
            ],
            [
                'label' => Icon::show('file', 'fa') . '内容区', 
                'options' => ['class' => 'header'],
            ],
            [
                'label' => '所有栏目',
                'icon' => 'fa fa-files-o',
                'url' => '#',
                'items'=> Node::getMenuItems(),
                'active' => Yii::$app->controller->id == 'node',
            ],
            [
                'label' => Icon::show('file', 'fa') . '用户区', 
                'options' => ['class' => 'header'],
            ],
            [
                'label' => '用户管理',
                'url' => ['user/index'],
                'icon' => 'fa fa-users',
                'active' => Yii::$app->controller->id == 'user',
            ],
            [
                'label' => '权限组管理',
                'url' => ['rbac/index'],
                'icon' => 'fa fa-key',
                'active' => Yii::$app->controller->id == 'rbac',
            ],
            [
                'label' => '编辑组管理',
                'url' => ['authority/index'],
                'icon' => 'fa fa-user-secret',
                'active' => Yii::$app->controller->id == 'authority',
            ],
        ],
    ])
    ?>

    <div class="content-wrapper">
        <section class="content-header">
            <?php if(isset($this->params['mainTitle'])): ?>
            <?= Html::tag('h1', $this->params['mainTitle'] . (empty($this->params['subTitle']) ?: Html::tag('small', $this->params['subTitle']))) ?>
            <?php endif; ?>
            <?= Breadcrumbs::widget([
                'homeLink' => [
                    'label' => Icon::show('dashboard', 'fa') . '仪表盘',
                    'encode' => false,
                    'url' => Yii::$app->homeUrl
                ],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
        </section>
        <section class="content">
            <?php echo $content;?>
        </section>

    </div>

    <footer class="main-footer">
        <div class="pull-right hidden-xs">Yii CMS 版本号：v2.4.0</div>
        <strong>Copyright © 2009-2017 <a href="http://www.yiichina.com">Yii China</a>.</strong>
        All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
