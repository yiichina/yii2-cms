<?php

/* @var $this yii\web\View */
use yii\bootstrap\Carousel;
use yiichina\adminlte\Box;
use yiichina\icons\Icon;
use yii\helpers\Html;
$this->title = Yii::$app->name . ' - 专业的高度可定制化的开源 CMS';
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
                <div class="btn-toolbar" role="toolbar">
                    <div class="btn-group">
                        <a class="btn btn-danger" href="http://admin.yiicms.com"><?= Icon::show('briefcase') ?>后台演示</a>
                    </div>
                    <div class="btn-group">
                        <a class="btn btn-primary" href="https://github.com/yiichina/yii2-cms"><?= Icon::show('github') ?>Git Hub</a>
                    </div>
                    <div class="btn-group">
                        <a class="btn btn-success" href="http://www.yiichina.com"><?= Icon::show('play-circle') ?>开始使用</a>
                    </div>
                </div>
            </p>
        </div>
    </div>
</div>
<div class="features">
    <div class="row">
        <div class="col-lg-6">
            <div class="media">
                <div class="media-left">
                    <span class="fa-stack fa-4x text-green">
                      <i class="fa fa-circle fa-stack-2x"></i>
                      <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <div class="media-body">
                    <h3 class="media-heading">开源免费</h3>
                    <p>
                        Yii CMS 基于 Yii Framework 开发，它开源、免费，用户可以自由下载、使用、修改、学习交流。
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="media">
                <div class="media-left">
                    <span class="fa-stack fa-4x text-red">
                      <i class="fa fa-circle fa-stack-2x"></i>
                      <i class="fa fa-hourglass-half fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <div class="media-body">
                    <h3 class="media-heading">快速高效</h3>
                    <p>
                        Yii 只加载您需要的功能。它具有强大的缓存支持。它明确的设计能与 AJAX 一起高效率的工作。
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="media">
                <div class="media-left">
                    <span class="fa-stack fa-4x text-light-blue">
                      <i class="fa fa-circle fa-stack-2x"></i>
                      <i class="fa fa-thumbs-o-up fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <div class="media-body">
                    <h3 class="media-heading">专业稳定</h3>
                    <p>
                        Yii 可帮助您开发清洁和可重用的代码。它遵循了 MVC 模式，确保了清晰分离逻辑层和表示层。
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="media">
                <div class="media-left">
                    <span class="fa-stack fa-4x text-yellow">
                      <i class="fa fa-circle fa-stack-2x"></i>
                      <i class="fa fa-cubes fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <div class="media-body">
                    <h3 class="media-heading">易用扩展</h3>
                    <p>
                        Yii CMS 功能强大，易于扩展，并支持二次开发。
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <?php Box::begin([
            'options' => ['class' => 'box-success'],
            'title' => Icon::show('calendar') . '最新动态',
        ]); ?>
        <ul class="article">
            <?php foreach($news as $data): ?>
            <li><?= Html::a($data->title, ['view', 'id' => $data->id]) ?><span class="pull-right"><?= date('Y-m-d', $data->created_at) ?></span></li>
            <?php endforeach; ?>
        </ul>
        <?php Box::end(); ?>
    </div>
    <div class="col-lg-6">
        <?php Box::begin([
            'options' => ['class' => 'box-primary'],
            'title' => Icon::show('question-circle-o') . '常见问题',
        ]); ?>
        <ul class="article">
            <?php foreach($faqs as $data): ?>
                <li><?= Html::a($data->title, ['view', 'id' => $data->id]) ?><span class="pull-right"><?= date('Y-m-d', $data->created_at) ?></span></li>
            <?php endforeach; ?>
        </ul>
        <?php Box::end(); ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <?php Box::begin([
            'options' => ['class' => 'box-danger'],
            'title' => Icon::show('users') . '最新会员',
        ]); ?>
        <ul class="users-list clearfix">
            <li>
                <img src="https://adminlte.io/themes/AdminLTE/dist/img/user1-128x128.jpg" alt="User Image">
                <a class="users-list-name" href="#">Alexander Pierce</a>
                <span class="users-list-date">Today</span>
            </li>
            <li>
                <img src="https://adminlte.io/themes/AdminLTE/dist/img/user8-128x128.jpg" alt="User Image">
                <a class="users-list-name" href="#">Norman</a>
                <span class="users-list-date">Yesterday</span>
            </li>
            <li>
                <img src="https://adminlte.io/themes/AdminLTE/dist/img/user7-128x128.jpg" alt="User Image">
                <a class="users-list-name" href="#">Jane</a>
                <span class="users-list-date">12 Jan</span>
            </li>
            <li>
                <img src="https://adminlte.io/themes/AdminLTE/dist/img/user6-128x128.jpg" alt="User Image">
                <a class="users-list-name" href="#">John</a>
                <span class="users-list-date">12 Jan</span>
            </li>
            <li>
                <img src="https://adminlte.io/themes/AdminLTE/dist/img/user2-160x160.jpg" alt="User Image">
                <a class="users-list-name" href="#">Alexander</a>
                <span class="users-list-date">13 Jan</span>
            </li>
            <li>
                <img src="https://adminlte.io/themes/AdminLTE/dist/img/user5-128x128.jpg" alt="User Image">
                <a class="users-list-name" href="#">Sarah</a>
                <span class="users-list-date">14 Jan</span>
            </li>
            <li>
                <img src="https://adminlte.io/themes/AdminLTE/dist/img/user4-128x128.jpg" alt="User Image">
                <a class="users-list-name" href="#">Nora</a>
                <span class="users-list-date">15 Jan</span>
            </li>
            <li>
                <img src="https://adminlte.io/themes/AdminLTE/dist/img/user3-128x128.jpg" alt="User Image">
                <a class="users-list-name" href="#">Nadia</a>
                <span class="users-list-date">15 Jan</span>
            </li>
        </ul>
        <?php Box::end(); ?>
    </div>
    <div class="col-lg-6">
        <?php Box::begin([
            'options' => ['class' => 'box-warning'],
            'title' => Icon::show('comments-o') . '最新评论',
        ]); ?>
        <div class="box-footer box-comments">
            <div class="box-comment">
                <!-- User image -->
                <img class="img-circle img-sm" src="https://adminlte.io/themes/AdminLTE/dist/img/user3-128x128.jpg" alt="User Image">

                <div class="comment-text">
                      <span class="username">
                        Maria Gonzales
                        <span class="text-muted pull-right">8:03 PM Today</span>
                      </span><!-- /.username -->
                    It is a long established fact that a reader will be distracted
                    by the readable content of a page when looking at its layout.
                </div>
                <!-- /.comment-text -->
            </div>
            <!-- /.box-comment -->
            <div class="box-comment">
                <!-- User image -->
                <img class="img-circle img-sm" src="https://adminlte.io/themes/AdminLTE/dist/img/user4-128x128.jpg" alt="User Image">

                <div class="comment-text">
                      <span class="username">
                        Luna Stark
                        <span class="text-muted pull-right">8:03 PM Today</span>
                      </span><!-- /.username -->
                    It is a long established fact that a reader will be distracted
                    by the readable content of a page when looking at its layout.
                </div>
                <!-- /.comment-text -->
            </div>
            <!-- /.box-comment -->
            <div class="box-comment">
                <!-- User image -->
                <img class="img-circle img-sm" src="https://adminlte.io/themes/AdminLTE/dist/img/user3-128x128.jpg" alt="User Image">

                <div class="comment-text">
                      <span class="username">
                        Maria Gonzales
                        <span class="text-muted pull-right">8:03 PM Today</span>
                      </span><!-- /.username -->
                    It is a long established fact that a reader will be distracted
                    by the readable content of a page when looking at its layout.
                </div>
                <!-- /.comment-text -->
            </div>
            <!-- /.box-comment -->
            <div class="box-comment">
                <!-- User image -->
                <img class="img-circle img-sm" src="https://adminlte.io/themes/AdminLTE/dist/img/user4-128x128.jpg" alt="User Image">

                <div class="comment-text">
                      <span class="username">
                        Luna Stark
                        <span class="text-muted pull-right">8:03 PM Today</span>
                      </span><!-- /.username -->
                    It is a long established fact that a reader will be distracted
                    by the readable content of a page when looking at its layout.
                </div>
                <!-- /.comment-text -->
            </div>
            <!-- /.box-comment -->
        </div>
        <?php Box::end(); ?>
    </div>
</div>