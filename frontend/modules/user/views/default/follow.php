<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use frontend\widgets\Helper;
use frontend\widgets\Follow;

$this->title = $model->username . ' 的关注 - 个人主页 - ' . Yii::$app->name;
$this->params['breadcrumbs'][] = ['label' => '个人主页', 'url' => ['/user/default']];
$this->params['breadcrumbs'][] = $model->username . ' 的关注';
?>

<div class="page-header">
    <h2><?= $model->username ?> 的关注 <small>(<?= $model->getFans()->count() ?>)</small></h2>
</div>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'options' => ['tag' => 'ul', 'class' => 'media-list'],
    'itemOptions' => ['tag' => 'li', 'class' => 'media'],
    'layout' => "{items}\n{pager}",
    'itemView' => function ($model, $key, $index, $widget) {
        return Html::tag('div', Html::a(Html::img($model->user->avatar, ['class' => 'media-object', 'alt' => $model->user->username]), $model->user->url, ['rel' => 'author']), ['class'=>'media-left']) .
        Html::tag('div', 
            Html::tag('h2', Html::a($model->user->username, $model->user->url, ['rel' => 'author']), ['class' => 'media-heading']) . 
            Html::tag('div', Helper::date('Y-m-d H:i', $model->created_at), ['class' => 'media-action']),
        ['class' => 'media-body']) .
        Html::tag('div', Follow::widget(['id' => $model->user->id]), ['class' => 'media-right']);
    },
]) ?>
