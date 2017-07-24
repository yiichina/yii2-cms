<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yiichina\adminlte\Box;
/* @var $this yii\web\View */
/* @var $searchModel common\models\TemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$mainTitle = '模板管理';
$subTitle = '模板列表';
$this->title = $subTitle . ' - ' . $mainTitle . ' - ' . Yii::$app->name;
$breadcrumbs[] = ['label' => $mainTitle, 'url' => ['index']];
$breadcrumbs[] = $subTitle;
$this->params = array_merge($this->params, compact('mainTitle', 'subTitle', 'breadcrumbs'));
?>
<div class="template-index">

<?php Box::begin([
    'type' => 'primary',
    'title' => '高级搜索',
    'tools' => ['collapse'],
    'collapsed' => true
]); ?>
<?= $this->render('_search', ['model' => $searchModel]) ?>
<?php Box::end(); ?>

<?php Box::begin([
    'type' => 'primary',
    'title' => $subTitle,
    'tools' => ['refresh', 'collapse', 'remove'],
    'collapsed' => false
]); ?>
<?= Html::a('Create Template', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
<?php Pjax::begin(); ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\CheckboxColumn'],
        'id',
        'user_id',
        'status',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]) ?>
<?php Pjax::end(); ?>
<?php Box::end(); ?>
</div>
