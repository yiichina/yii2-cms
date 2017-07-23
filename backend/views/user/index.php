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
    'columns' => [
        ['class' => 'yii\grid\CheckboxColumn'],
        'id',
        'username',
        'email',
        'created_at',
        'status',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
<?php Pjax::end(); ?>
<?php Box::end(); ?>
</div>
