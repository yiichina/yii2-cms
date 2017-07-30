<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use frontend\widgets\Helper;
use yii\bootstrap\Nav;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '我的私信 - ' . Yii::$app->name;
$this->params['breadcrumbs'][] = ['label' => '我的私信', 'url' => ['index']];
$this->params['breadcrumbs'][] = '私信列表';
?>

<div class="page-header">
    <h1>我的私信</h1>
    <?= Html::a(Helper::icon('plus') . '发新私信', ['create'], ['class' => 'btn btn-success btn-sm pull-right']) ?>
</div>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'options' => ['tag' => 'ul', 'class' => 'media-list'],
    'itemOptions' => ['tag' => 'li', 'class' => 'media'],
    'layout' => "{items}\n{pager}",
    'itemView' => function ($model, $key, $index, $widget) {
        return Html::tag('div', Html::a(Html::img($model->contact->avatar, ['class' => 'media-object', 'alt' => $model->contact->username]), $model->contact->url, ['rel' => 'author']), ['class'=>'media-left']) .
        Html::tag('div',
            Html::tag('div', Html::a($model->contact->username, $model->contact->url, ['rel' => 'author']), ['class' => 'media-heading']) .
            Html::tag('div', $model->content, ['class' => 'media-content']) . 
            Html::tag('div',
                Helper::date('Y-m-d H:i', $model->created_at) .
                Html::tag('span', $model->read . ' | ' . Html::a("回复({$model->getReplies()->count()})", $model->url), ['class' => 'pull-right']),
            ['class'=>'media-action']), 
        ['class' => 'media-body']);
    },
]) ?>
