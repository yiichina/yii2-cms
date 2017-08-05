<?php

/* @var $this yii\web\View */
use yii\bootstrap\Carousel;
use yiichina\adminlte\SmallBox;
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
            // the item contains only the image
            '<img src="http://placehold.it/900x500/39CCCC/ffffff&text=I+Love+Bootstrap"/>',
            // equivalent to the above
            ['content' => '<img src="http://placehold.it/900x500/3c8dbc/ffffff&text=I+Love+Bootstrap"/>'],
            // the item contains both the image and the caption
            [
                'content' => '<img src="http://placehold.it/900x500/f39c12/ffffff&text=I+Love+Bootstrap"/>',
                'caption' => '<h4>This is title</h4><p>This is the caption text</p>',
            ],
        ]
    ]) ?>
    </div>
    <div class="col-lg-6">
        <div class="jumbotron">
            <h1>Congratulations!</h1>

            <p class="lead">You have successfully created your Yii-powered application.</p>

            <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <?php SmallBox::begin([
            'options' => ['class' => 'bg-aqua'],
            'icon' => Icon::show('file'),
            'footer' => ['label' => '更多信息' . Icon::show('arrow-circle-right', 'fa', ' ', null), 'url' => '#'],
        ]);
        echo Html::tag('h3', '快速');
        echo Html::tag('p', '栏目总数');
        SmallBox::end(); ?>
    </div>
    <div class="col-lg-3 col-xs-6">
        <?php SmallBox::begin([
            'options' => ['class' => 'bg-aqua'],
            'icon' => Icon::show('file'),
            'footer' => ['label' => '更多信息' . Icon::show('arrow-circle-right', 'fa', ' ', null), 'url' => '#'],
        ]);
        echo Html::tag('h3', 150);
        echo Html::tag('p', '模板总数');
        SmallBox::end(); ?>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <?php SmallBox::begin([
            'options' => ['class' => 'bg-aqua'],
            'icon' => Icon::show('file'),
            'footer' => ['label' => '更多信息' . Icon::show('arrow-circle-right', 'fa', ' ', null), 'url' => '#'],
        ]);
        echo Html::tag('h3', 150);
        echo Html::tag('p', '用户总数');
        SmallBox::end(); ?>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <?php SmallBox::begin([
            'options' => ['class' => 'bg-aqua'],
            'icon' => Icon::show('file'),
            'footer' => ['label' => '更多信息' . Icon::show('arrow-circle-right', 'fa', ' ', null), 'url' => '#'],
        ]);
        echo Html::tag('h3', 150);
        echo Html::tag('p', '文章总数');
        SmallBox::end(); ?>
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
