<?php

use yii\helpers\Html;
use backend\widgets\GridView;
use yii\widgets\Pjax;
use yiichina\adminlte\Box;
use yiichina\icons\Icon;
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
        'options' => ['class' => 'box-primary'],
        'title' => $subTitle,
        'tools' => Html::a(Icon::show('search-plus', 'fa') . '高级搜索', 'javascript:void(0)', ['class' => 'btn btn-sm btn-flat btn-primary btn-search']),
    ]); ?>
    <?php Pjax::begin(); ?>
    <div class="search">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'batchItems' => [
            ['label' => '禁用', 'url' => ['disable']],
            ['label' => '启用', 'url' => ['enable']],
        ],
        'button' => Html::a(Icon::show('plus', 'fa') . '新建发布点', ['create'], ['class' => 'btn btn-sm btn-flat btn-success']),
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
                'attribute' => 'key',
                'options' => ['width' => 120],
            ],
            'template_id',
            'description',
            [
                'attribute' => 'status',
                'options' => ['width' => 100],
                'value' => function($data) {
                    return $data->statusLabel;
                },
                'format' => 'raw',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'options' => ['width' => 80],
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a(Icon::show('edit') . '修改', $url);
                    },
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
    <?php Box::end(); ?>
</div>
