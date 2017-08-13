<?php

use yiichina\adminlte\Box;
use yiichina\adminlte\SmallBox;
use yiichina\icons\Icon;
use yii\helpers\Html;
use yiichina\chart\Chart;

/* @var $this yii\web\View */

$mainTitle = '仪表盘';
$subTitle = '控制面板';
$this->title = $subTitle . ' - ' . $mainTitle . ' - ' . Yii::$app->name;
$breadcrumbs[] = $subTitle;
$this->params = array_merge($this->params, compact('mainTitle', 'subTitle', 'breadcrumbs'));
?>
<div class="site-index">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <?php SmallBox::begin([
                'options' => ['class' => 'bg-aqua'],
                'icon' => Icon::show('user-plus'),
                'footer' => ['label' => '更多信息' . Icon::show('arrow-circle-right', 'fa', ' ', null), 'url' => ['/user']],
            ]);
            echo Html::tag('h3', 150);
            echo Html::tag('p', '用户总数');
            SmallBox::end(); ?>
        </div>
        <div class="col-lg-3 col-xs-6">
            <?php SmallBox::begin([
                'options' => ['class' => 'bg-green'],
                'icon' => Icon::show('file-text-o'),
                'footer' => ['label' => '更多信息' . Icon::show('arrow-circle-right', 'fa', ' ', null), 'url' => ['/post/index', 'type' => 1]],
            ]);
            echo Html::tag('h3', 150);
            echo Html::tag('p', '文章总数');
            SmallBox::end(); ?>
        </div>
        <div class="col-lg-3 col-xs-6">
            <?php SmallBox::begin([
                'options' => ['class' => 'bg-yellow'],
                'icon' => Icon::show('photo'),
                'footer' => ['label' => '更多信息' . Icon::show('arrow-circle-right', 'fa', ' ', null), 'url' => ['/post/index', 'type' => 2]],
            ]);
            echo Html::tag('h3', 150);
            echo Html::tag('p', '图集总数');
            SmallBox::end(); ?>
        </div>
        <div class="col-lg-3 col-xs-6">
            <?php SmallBox::begin([
                'options' => ['class' => 'bg-red'],
                'icon' => Icon::show('video-camera'),
                'footer' => ['label' => '更多信息' . Icon::show('arrow-circle-right', 'fa', ' ', null), 'url' => ['/post/index', 'type' => 3]],
            ]);
            echo Html::tag('h3', 150);
            echo Html::tag('p', '视频总数');
            SmallBox::end(); ?>
        </div>
    </div>
    <div class="row">
        <section class="col-lg-7">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li><a href="#year-chart" data-toggle="tab">按年</a></li>
                    <li><a href="#month-chart" data-toggle="tab">按月</a></li>
                    <li class="active"><a href="#week-chart" data-toggle="tab">按周</a></li>
                    <li class="pull-left header"><i class="fa fa-line-chart"></i> 发稿统计</li>
                </ul>
                <div class="tab-content no-padding">
                    <div class="chart tab-pane active" id="week-chart" style="position: relative; height: 300px;">
                        <?= Chart::widget([
                            'type' => 'line',
                            'options' => [
                                'height' => 200,
                                'width' => 400
                            ],
                            'data' => [
                                'labels' => ["January", "February", "March", "April", "May", "June", "July"],
                                'datasets' => [
                                    [
                                        'label' => "My First dataset",
                                        'backgroundColor' => "rgba(179,181,198,0.2)",
                                        'borderColor' => "rgba(179,181,198,1)",
                                        'pointBackgroundColor' => "rgba(179,181,198,1)",
                                        'pointBorderColor' => "#fff",
                                        'pointHoverBackgroundColor' => "#fff",
                                        'pointHoverBorderColor' => "rgba(179,181,198,1)",
                                        'data' => [65, 59, 90, 81, 56, 55, 40]
                                    ]
                                ]
                            ]
                        ]) ?>
                    </div>
                    <div class="chart tab-pane" id="month-chart" style="position: relative; height: 300px;"></div>
                    <div class="chart tab-pane" id="year-chart" style="position: relative; height: 300px;"></div>
                </div>
            </div>
        </section>
        <section class="col-lg-5">
            <?php Box::begin([
                'options' => ['class' => 'box-success'],
                'title' => '发稿日历',
            ]); ?>
            <?php Box::end(); ?>
        </section>
    </div>
    <div class="row">
        <div class="col-lg-7">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">最近编辑</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Item</th>
                                <th>Status</th>
                                <th>Popularity</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                <td>Call of Duty IV</td>
                                <td><span class="label label-success">Shipped</span></td>
                                <td>
                                    <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63
                                    </div>
                                </td>
                            </tr>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer clearfix">
                    <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Latest Members</h3>

                    <div class="box-tools pull-right">
                        <span class="label label-danger">8 New Members</span>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <ul class="users-list clearfix">
                        <li>
                            <img src="dist/img/user1-128x128.jpg" alt="User Image">
                            <a class="users-list-name" href="#">Alexander Pierce</a>
                            <span class="users-list-date">Today</span>
                        </li>
                        <li>
                            <img src="dist/img/user8-128x128.jpg" alt="User Image">
                            <a class="users-list-name" href="#">Norman</a>
                            <span class="users-list-date">Yesterday</span>
                        </li>
                        <li>
                            <img src="dist/img/user7-128x128.jpg" alt="User Image">
                            <a class="users-list-name" href="#">Jane</a>
                            <span class="users-list-date">12 Jan</span>
                        </li>
                        <li>
                            <img src="dist/img/user6-128x128.jpg" alt="User Image">
                            <a class="users-list-name" href="#">John</a>
                            <span class="users-list-date">12 Jan</span>
                        </li>
                    </ul>
                </div>
                <div class="box-footer text-center">
                    <a href="javascript:void(0)" class="uppercase">View All Users</a>
                </div>
            </div>
        </div>
    </div>
</div>
