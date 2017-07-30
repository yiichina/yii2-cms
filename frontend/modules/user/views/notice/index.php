<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Nav;
use yii\widgets\ListView;

/**
 * @var yii\web\View $this
 */
$this->title = '我的提醒 - ' . Yii::$app->name;
$this->params['breadcrumbs'][] = '我的提醒';
?>

<div class="page-header">
    <h1>我的提醒</h1>
    <?= Nav::widget([
        'items' => [
            ['label' => '全部提醒', 'url' => ['notice/index'], 'active' => empty($_GET['type'])],
            ['label' => '私信', 'url' => ['notice/index', 'type' => 'message']],
            ['label' => '访客', 'url' => ['notice/index', 'type' => 'visit']],
            ['label' => '粉丝', 'url' => ['notice/index', 'type' => 'follow']],
            ['label' => '说说', 'url' => ['notice/index', 'type' => 'feed']],
            ['label' => '评论', 'url' => ['notice/index', 'type' => 'comment']],
            ['label' => '回答', 'url' => ['notice/index', 'type' => 'answer']],
            ['label' => '回复', 'url' => ['notice/index', 'type' => 'reply']],
            ['label' => '最佳答案', 'url' => ['notice/index', 'type' => 'best']],
            ['label' => '评价', 'url' => ['notice/index', 'type' => 'vote']],
            ['label' => '收藏', 'url' => ['notice/index', 'type' => 'favorite']],
            ['label' => '@我', 'url' => ['notice/index', 'type' => 'mention']],
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
        return $model->media;
    },
]) ?>
