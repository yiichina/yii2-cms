<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yiichina\adminlte\Box;
/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$mainTitle = '用户管理';
$subTitle = '用户列表';
$this->title = $subTitle . ' - ' . $mainTitle . ' - ' . Yii::$app->name;
$breadcrumbs[] = ['label' => $mainTitle, 'url' => ['index']];
$breadcrumbs[] = $subTitle;
$this->params = array_merge($this->params, compact('mainTitle', 'subTitle', 'breadcrumbs'));
?>
<div class="user-index">
<?php Box::begin([
    'type' => 'primary',
    'title' => '高级搜索',
    'tools' => ['collapse'],
    'collapsed' => true
]); ?>
<?php echo $this->render('_search', ['model' => $searchModel]); ?>
<?php Box::end(); ?>

<?php Box::begin([
    'type' => 'primary',
    'title' => $subTitle,
    'tools' => ['refresh', 'collapse', 'remove'],
    'collapsed' => false
]); ?>
<?php Pjax::begin(); ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'layout' => "<div class=\"grid-tool\">
     <div class=\"btn-group\">
                  <button type=\"button\" class=\"btn btn-warning btn-sm btn-flat\">批量操作</button>
                  <button type=\"button\" class=\"btn btn-warning btn-sm btn-flat dropdown-toggle\" data-toggle=\"dropdown\">
                    <span class=\"caret\"></span>
                    <span class=\"sr-only\">Toggle Dropdown</span>
                  </button>
                  <ul class=\"dropdown-menu\" role=\"menu\">
                    <li><a href=\"#\">Action</a></li>
                    <li><a href=\"#\">Another action</a></li>
                    <li><a href=\"#\">Something else here</a></li>
                    <li class=\"divider\"></li>
                    <li><a href=\"#\">Separated link</a></li>
                  </ul>
                </div><div class=\"pull-right\"><select class=\"select2\"></select></div>
<div class=\"pull-right\">{summary}</div></div>\n{items}\n{pager}",
    'columns' => [
        [
            'class' => 'yii\grid\CheckboxColumn',
            'options' => ['width' => 30],
        ],
        [
            'attribute' => 'id',
            'options' => ['width' => 60],
        ],
        [
            'attribute' => 'username',
            'options' => ['width' => 120],
        ],
        'email',
        [
            'attribute' => 'created_at',
            'options' => ['width' => 150],
            'format' => ['date', 'php:Y-m-d H:i:s'],
        ],
        'status',
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => '操作',
            'options' => ['width' => 120],
        ],
    ],
]); ?>
<?php Pjax::end(); ?>
<?php Box::end(); ?>
</div>
