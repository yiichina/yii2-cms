<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use backend\assets\AppAsset;
use yiichina\adminlte\Nav;
use yiichina\adminlte\NavBar;
use yiichina\adminlte\SideBar;
use yiichina\icons\Icon;
use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;
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
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('@web/images/logo.png', ['alt' => 'Yii CMS']) . 'Yii CMS',
        'brandLabelMini' => Html::img('@web/images/logo.png', ['alt' => 'Yii CMS']),
    ]);
    echo Nav::widget([
        'encodeLabels' => false,
        'dropDownCaret' => '',
        'options' => ['class' => 'navbar-nav'],
        'items' => [
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
                    Html::tag('li', 'hello', ['class' => 'user-footer']),
                ],
            ],
            [
                'label' => Icon::show('gears'),
                'url' => '#',
                'linkOptions' => ['data' => ['toggle' => 'control-sidebar']],
            ]
        ],
    ]);
    NavBar::end();
    Sidebar::begin([
        'encodeLabels' => false,
		'defaultRight' => Icon::show('angle-left', 'fa', null, null, ['class' => 'pull-right']),
        'items' => [
            [
				'icon' => Icon::show('cogs'),
                'label' => '工具区',
                'options' => ['class' =>'header'],
            ],
            [
				'icon' => Icon::show('dashboard'),
                'label' => '仪表盘', 
                'url' => Yii::$app->homeUrl, 
                'active' => Yii::$app->controller->id == 'site',
            ],
            [
				'icon' => Icon::show('columns', 'fa'),
                'label' => '栏目管理',
                'url' => ['node/index'],
                'active' => Yii::$app->controller->id == 'node',
            ],
            [
				'icon' => Icon::show('file-code-o', 'fa'),
                'label' => '模板管理',
                'url' => ['template/index'],
                'active' => Yii::$app->controller->id == 'template',
            ],
            [
				'icon' => Icon::show('file', 'fa'),
                'label' => '内容区', 
                'options' => ['class' => 'header'],
            ],
            [
				'icon' => Icon::show('files-o', 'fa'),
                'label' => '所有栏目',
				'url' => '#',
                'items'=> Node::getMenuItems(),
                'active' => Yii::$app->controller->id == 'post',
            ],
            [
				'icon' => Icon::show('users', 'fa'),
                'label' => '用户区', 
                'options' => ['class' => 'header'],
            ],
            [
				'icon' => Icon::show('user', 'fa'),
                'label' => '用户管理',
                'url' => ['user/index'],
                'active' => Yii::$app->controller->id == 'user',
            ],
            [
				'icon' => Icon::show('key', 'fa'),
                'label' => '权限管理',
                'url' => ['rbac/index'],
                'active' => in_array(Yii::$app->controller->id, ['permission', 'role', 'rule']),
                'items' => [
                    [
                        'icon' => Icon::show('circle-o', 'fa'),
                        'label' => '权限项管理',
                        'url' => ['permission/index'],
                        'active' => Yii::$app->controller->id == 'permission',
                    ],
                    [
                        'icon' => Icon::show('circle-o', 'fa'),
                        'label' => '角色管理',
                        'url' => ['role/index'],
                    ],
                    [
                        'icon' => Icon::show('circle-o', 'fa'),
                        'label' => '规则管理',
                        'url' => ['rule/index'],
                    ],
                ],
            ],
            [
				'icon' => Icon::show('user-secret', 'fa'),
                'label' => Html::tag('span', '编辑组管理'),
                'url' => ['group/index'],
                'active' => Yii::$app->controller->id == 'authority',
            ],
        ],
    ]);
    echo Html::beginForm(['/site/search'], 'get', ['class' => 'sidebar-form']);
    echo Html::tag('div', Html::textInput('q', Yii::$app->request->get('q'), ['class' => 'form-control', 'placeholder' => '搜索']) . Html::tag('span', Html::submitButton('<span class="fa fa-search"></span>', ['class'=>'btn btn-flat']), ['class'=>'input-group-btn']), ['class'=>'input-group']);
    echo Html::endForm();
    SideBar::end();
    ?>

    <div class="content-wrapper">
        <section class="content-header">
            <?php if(isset($this->params['mainTitle'])): ?>
            <?= Html::tag('h1', $this->params['mainTitle'] . (empty($this->params['subTitle']) ?: Html::tag('small', $this->params['subTitle']))) ?>
            <?php endif; ?>
            <?= Breadcrumbs::widget([
                'homeLink' => [
                    'label' => Icon::show('dashboard') . '仪表盘',
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
	<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-theme-demo-options-tab" data-toggle="tab"><i class="fa fa-wrench"></i></a></li><li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div><div id="control-sidebar-theme-demo-options-tab" class="tab-pane active"><div><h4 class="control-sidebar-heading">Layout Options</h4><div class="form-group"><label class="control-sidebar-subheading"><input type="checkbox" data-layout="fixed" class="pull-right"> Fixed layout</label><p>Activate the fixed layout. You can't use fixed and boxed layouts together</p></div><div class="form-group"><label class="control-sidebar-subheading"><input type="checkbox" data-layout="layout-boxed" class="pull-right"> Boxed Layout</label><p>Activate the boxed layout</p></div><div class="form-group"><label class="control-sidebar-subheading"><input type="checkbox" data-layout="sidebar-collapse" class="pull-right"> Toggle Sidebar</label><p>Toggle the left sidebar's state (open or collapse)</p></div><div class="form-group"><label class="control-sidebar-subheading"><input type="checkbox" data-enable="expandOnHover" class="pull-right"> Sidebar Expand on Hover</label><p>Let the sidebar mini expand on hover</p></div><div class="form-group"><label class="control-sidebar-subheading"><input type="checkbox" data-controlsidebar="control-sidebar-open" class="pull-right"> Toggle Right Sidebar Slide</label><p>Toggle between slide over content and push content effects</p></div><div class="form-group"><label class="control-sidebar-subheading"><input type="checkbox" data-sidebarskin="toggle" class="pull-right"> Toggle Right Sidebar Skin</label><p>Toggle between dark and light skins for the right sidebar</p></div><h4 class="control-sidebar-heading">Skins</h4><ul class="list-unstyled clearfix"><li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0)" data-skin="skin-blue" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover"><div><span style="display:block; width: 20%; float: left; height: 7px; background: #367fa9"></span><span class="bg-light-blue" style="display:block; width: 80%; float: left; height: 7px;"></span></div><div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div></a><p class="text-center no-margin">Blue</p></li><li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0)" data-skin="skin-black" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover"><div style="box-shadow: 0 0 2px rgba(0,0,0,0.1)" class="clearfix"><span style="display:block; width: 20%; float: left; height: 7px; background: #fefefe"></span><span style="display:block; width: 80%; float: left; height: 7px; background: #fefefe"></span></div><div><span style="display:block; width: 20%; float: left; height: 20px; background: #222"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div></a><p class="text-center no-margin">Black</p></li><li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0)" data-skin="skin-purple" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover"><div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-purple-active"></span><span class="bg-purple" style="display:block; width: 80%; float: left; height: 7px;"></span></div><div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div></a><p class="text-center no-margin">Purple</p></li><li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0)" data-skin="skin-green" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover"><div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-green-active"></span><span class="bg-green" style="display:block; width: 80%; float: left; height: 7px;"></span></div><div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div></a><p class="text-center no-margin">Green</p></li><li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0)" data-skin="skin-red" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover"><div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-red-active"></span><span class="bg-red" style="display:block; width: 80%; float: left; height: 7px;"></span></div><div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div></a><p class="text-center no-margin">Red</p></li><li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0)" data-skin="skin-yellow" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover"><div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-yellow-active"></span><span class="bg-yellow" style="display:block; width: 80%; float: left; height: 7px;"></span></div><div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div></a><p class="text-center no-margin">Yellow</p></li><li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0)" data-skin="skin-blue-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover"><div><span style="display:block; width: 20%; float: left; height: 7px; background: #367fa9"></span><span class="bg-light-blue" style="display:block; width: 80%; float: left; height: 7px;"></span></div><div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div></a><p class="text-center no-margin" style="font-size: 12px">Blue Light</p></li><li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0)" data-skin="skin-black-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover"><div style="box-shadow: 0 0 2px rgba(0,0,0,0.1)" class="clearfix"><span style="display:block; width: 20%; float: left; height: 7px; background: #fefefe"></span><span style="display:block; width: 80%; float: left; height: 7px; background: #fefefe"></span></div><div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div></a><p class="text-center no-margin" style="font-size: 12px">Black Light</p></li><li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0)" data-skin="skin-purple-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover"><div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-purple-active"></span><span class="bg-purple" style="display:block; width: 80%; float: left; height: 7px;"></span></div><div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div></a><p class="text-center no-margin" style="font-size: 12px">Purple Light</p></li><li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0)" data-skin="skin-green-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover"><div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-green-active"></span><span class="bg-green" style="display:block; width: 80%; float: left; height: 7px;"></span></div><div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div></a><p class="text-center no-margin" style="font-size: 12px">Green Light</p></li><li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0)" data-skin="skin-red-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover"><div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-red-active"></span><span class="bg-red" style="display:block; width: 80%; float: left; height: 7px;"></span></div><div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div></a><p class="text-center no-margin" style="font-size: 12px">Red Light</p></li><li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0)" data-skin="skin-yellow-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover"><div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-yellow-active"></span><span class="bg-yellow" style="display:block; width: 80%; float: left; height: 7px;"></span></div><div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div></a><p class="text-center no-margin" style="font-size: 12px">Yellow Light</p></li></ul></div></div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked="">
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked="">
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked="">
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked="">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
