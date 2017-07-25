<?php

use yii\helpers\Html;
use common\widgets\GridView;
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
    'title' => $subTitle,
    'tools' => ['search', 'collapse', 'remove'],
    'collapsed' => false
]); ?>
<?php Pjax::begin(); ?>

<div class="search">
<?php echo $this->render('_search', ['model' => $searchModel]); ?>
</div>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'class' => 'yii\grid\CheckboxColumn',
            'options' => ['width' => 40],
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
            'options' => ['width' => 100],
        ],
    ],
]); ?>
<?php Pjax::end(); ?>
<?php Box::end(); ?>
</div>
