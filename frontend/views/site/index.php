<?php

/* @var $this yii\web\View */
use yii\bootstrap\Carousel;
use yiichina\adminlte\InfoBox;
use yiichina\adminlte\Box;
use yiichina\icons\Icon;
use yii\helpers\Html;
$this->title = 'My Yii Application';
?>
<div class="row">
    <div class="col-lg-6">
    <?= Carousel::widget([
        'options' => ['class' => 'slide', 'data' => ['ride' => 'carousel']],
        'controls' => ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>'],
        'items' => [
            [
                'content' => Html::img('@web/images/slide-1.jpg'),
                'caption' => '<h4>Yii CMS</h4>'
            ],
            // the item contains only the image
            Html::img('@web/images/slide-2.jpg'),
            // equivalent to the above
            [
                'content' => Html::img('@web/images/slide-3.jpg'),
                'caption' => '<h4>Yii CMS</h4><p>专业的高度可定制化的开源 CMS</p>'
            ],
        ]
    ]) ?>
    </div>
    <div class="col-lg-6">
        <div class="jumbotron">
            <h1>Yii CMS - 专业的高度可定制化的开源 CMS</h1>
            <h2>Yii CMS 是由 <a href="http://www.yiichina.com">Yii Framework 中文社区</a> 发起的开源项目，基于 Yii Framework 2.0 开发，遵循 BSD 开源协议。</h2>
            <p>Yii CMS 实现了高度可定制化，安装简单，使用方便。后台使用 adminLTE 主题，12 种配色，并且完美兼容移动端。功能丰富实用，例如：国际化支持，强大的缓存支持，基于角色的访问控制，第三方登录，自主开发的通用评论模块，并具有回复，分享，投票功能。</p>
            <p>
                <a class="btn btn-danger btn-flat" href="http://admin.yiicms.com"><?= Icon::show('briefcase') ?>后台演示</a>
                <a class="btn btn-primary btn-flat" href="https://github.com/yiichina/yii2-cms"><?= Icon::show('github') ?>Git Hub</a>
                <a class="btn btn-success btn-flat" href="http://www.yiiframework.com"><?= Icon::show('play-circle') ?>开始使用</a>
            </p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <?php InfoBox::begin([
            'options' => ['class' => 'bg-aqua'],
            'icon' => Icon::show('file'),
            'footer' => ['label' => '更多信息' . Icon::show('arrow-circle-right', 'fa', ' ', null), 'url' => '#'],
        ]);
        echo Html::tag('h3', '快速');
        echo Html::tag('p', '栏目总数');
        InfoBox::end(); ?>
    </div>
    <div class="col-lg-3 col-xs-6">
        <?php InfoBox::begin([
            'options' => ['class' => 'bg-aqua'],
            'icon' => Icon::show('file'),
            'footer' => ['label' => '更多信息' . Icon::show('arrow-circle-right', 'fa', ' ', null), 'url' => '#'],
        ]);
        echo Html::tag('h3', 150);
        echo Html::tag('p', '模板总数');
        InfoBox::end(); ?>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <?php InfoBox::begin([
            'options' => ['class' => 'bg-aqua'],
            'icon' => Icon::show('file'),
            'footer' => ['label' => '更多信息' . Icon::show('arrow-circle-right', 'fa', ' ', null), 'url' => '#'],
        ]);
        echo Html::tag('h3', 150);
        echo Html::tag('p', '用户总数');
        InfoBox::end(); ?>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <?php InfoBox::begin([
            'options' => ['class' => 'bg-aqua'],
            'icon' => Icon::show('file'),
            'footer' => ['label' => '更多信息' . Icon::show('arrow-circle-right', 'fa', ' ', null), 'url' => '#'],
        ]);
        echo Html::tag('h3', 150);
        echo Html::tag('p', '文章总数');
        InfoBox::end(); ?>
    </div>
    <!-- ./col -->
</div>
<div class="row">
    <div class="col-lg-6">
    <?php Box::begin([
        'options' => ['class' => 'box-primary'],
        'title' => '最新动态',
    ]); ?>

    <?php Box::end(); ?>
    </div>
    <div class="col-lg-6">
        <?php Box::begin([
            'options' => ['class' => 'box-primary'],
            'title' => '常见问题',
        ]); ?>

        <?php Box::end(); ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <?php Box::begin([
            'options' => ['class' => 'box-primary'],
            'title' => '最新会员',
        ]); ?>

        <?php Box::end(); ?>
    </div>
    <div class="col-lg-6">
        <?php Box::begin([
            'options' => ['class' => 'box-primary'],
            'title' => '最新评论',
        ]); ?>

        <?php Box::end(); ?>
    </div>
</div>