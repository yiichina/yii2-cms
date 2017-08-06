<?php

use yii\helpers\Html;

use backend\widgets\GridView;
use yii\widgets\Pjax;
use yiichina\adminlte\Box;
use yiichina\icons\Icon;
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
        'options' => ['class' => 'box-primary'],
        'title' => $subTitle,
        'tools' => Html::a(Icon::show('search-plus', 'fa') . '高级搜索', 'javascript:void(0);', ['class' => 'btn btn-sm btn-flat btn-primary btn-search']),
    ]); ?>
    <div class="search">
        <?= $this->render('_search', ['model' => $searchModel]) ?>
    </div>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'batchItems' => [
            ['label' => '禁用', 'url' => ['disable']],
            ['label' => '启用', 'url' => ['enable']],
        ],
        'button' => Html::a(Icon::show('plus', 'fa') . '新建栏目', ['create'], ['class' => 'btn btn-sm btn-flat btn-success']),
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
                'attribute' => 'user_id',
                'options' => ['width' => 100],
            ],
            [
                'attribute' => 'name',
                'options' => ['width' => 200],
            ],
            'description',
            [
                'attribute' => 'status',
                'options' => ['width' => 100],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'options' => ['width' => 65],
            ],
        ],
    ]) ?>
    <?php Pjax::end(); ?>
    <?php Box::end(); ?>
</div>
