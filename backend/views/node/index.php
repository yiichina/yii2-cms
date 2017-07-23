<?php

use yii\helpers\Html;
use yii\grid\GridView;
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
    'refreshUrl' => '/userinfo',
    'tools' => ['refresh', 'collapse', 'remove'],
    'collapsed' => false
]); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= Html::a(Yii::t('app', '创建栏目'), ['create'], ['class' => 'btn btn-success btn-flat pull-right']) ?>
<?php Pjax::begin(); ?>
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
