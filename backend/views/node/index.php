<?php

use yii\helpers\Html;
use backend\widgets\GridView;
use yii\widgets\Pjax;
use yiichina\adminlte\Box;
/* @var $this yii\web\View */
/* @var $searchModel common\models\NodeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$mainTitle = '栏目管理';
$subTitle = '栏目列表';
$this->title = $subTitle . ' - ' . $mainTitle . ' - ' . Yii::$app->name;
$breadcrumbs[] = ['label' => $mainTitle, 'url' => ['index']];
$breadcrumbs[] = $subTitle;
$this->params = array_merge($this->params, compact('mainTitle', 'subTitle', 'breadcrumbs'));
?>

<div class="node-index">
<?php Box::begin([
    'type' => 'primary',
    'title' => $subTitle,
    'tools' => ['refresh', 'collapse', 'remove'],
    'collapsed' => false
]); ?>
<?php Pjax::begin(); ?>
<div class="search">
<?php echo $this->render('_search', ['model' => $searchModel]); ?>
</div>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\CheckboxColumn'],
        'id',
        'parent_id',
        'name',
        'description',
        'status',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
<?php Pjax::end(); ?>
<?php Box::end(); ?>
</div>
