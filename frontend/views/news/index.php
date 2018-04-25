<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yiichina\adminlte\Box;
use yiichina\icons\Icon;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$mainTitle = '新闻中心';
$subTitle = '栏目列表';
$this->title = $subTitle . ' - ' . $mainTitle . ' - ' . Yii::$app->name;
$breadcrumbs[] = ['label' => $mainTitle, 'url' => ['index']];
$breadcrumbs[] = $subTitle;
$this->params = array_merge($this->params, compact('mainTitle', 'subTitle', 'breadcrumbs'));
?>
<div class="news-index">
    <div class="row">
        <div class="col-lg-3">
            <?php Box::begin([
                'options' => ['class' => 'box-primary'],
                'title' => $subTitle,
            ]); ?>
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemOptions' => ['class' => 'item'],
                'itemView' => function ($model, $key, $index, $widget) {
                    return Html::a(Html::encode($model->title), $model->url);
                },
            ]) ?>
            <?php Box::end(); ?>
        </div>
        <div class="col-lg-9">
            <?php Box::begin([
                'options' => ['class' => 'box-primary'],
                'title' => $subTitle,
            ]); ?>
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemOptions' => ['class' => 'item'],
                'itemView' => function ($model, $key, $index, $widget) {
                    return Html::a(Html::encode($model->title), $model->url);
                },
            ]) ?>
            <?php Box::end(); ?>
        </div>

    </div>
</div>
