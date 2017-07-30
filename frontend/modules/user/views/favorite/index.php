<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Nav;
use yii\widgets\ListView;
use frontend\widgets\Helper;
use frontend\widgets\Favorite;

/**
 * @var yii\web\View $this
 */
$this->title = '我的收藏 - ' . Yii::$app->name;
$this->params['breadcrumbs'][] = '我的收藏';
?>

<div class="page-header">
    <h1>我的收藏</h1>
    <?= Nav::widget([
        'items' => [
            ['label' => '全部收藏', 'url' => ['favorite/index'], 'active' => empty($_GET['type'])],
            ['label' => '教程', 'url' => ['favorite/index', 'type' => 'tutorial']],
            ['label' => '扩展', 'url' => ['favorite/index', 'type' => 'extension']],
            ['label' => '源码', 'url' => ['favorite/index', 'type' => 'code']],
            ['label' => '问答', 'url' => ['favorite/index', 'type' => 'question']],
            ['label' => '话题', 'url' => ['favorite/index', 'type' => 'topic']],
        ],
        'options' => ['class' => 'nav nav-tabs nav-main'],
    ]); ?>
</div>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'options' => ['tag' => 'ul', 'class' => 'media-list'],
    'itemOptions' => ['tag' => 'li', 'class' => 'media'],
    'layout' => "{items}\n{pager}",
    'itemView' => function ($model, $key, $index, $widget) {
        return Html::tag('div', Html::a(Html::img($model->item->user->avatar, ['class' => 'media-object', 'alt' => $model->item->user->username]), $model->item->user->url, ['rel' => 'author']), ['class' => 'media-left']) .
        Html::tag('div', 
            Html::tag('h2', Html::a($model->item->title, $model->item->url), ['class' => 'media-heading']) .
            Html::tag('div',
                Html::a($model->item->user->username, $model->item->user->url, ['rel' => 'author']) . ' 发布于 ' . Helper::date('Y-m-d H:i', $model->item->created_at) .
                Html::tag('span', Favorite::widget(['type' => $model->type, 'id' => $model->item->id, 'simple' => true]), ['class' => 'pull-right']),
            ['class' => 'media-action']), 
        ['class' => 'media-body']);
    },
]) ?>

