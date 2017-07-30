<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\bootstrap\Nav;
use frontend\widgets\Helper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '我的发布' . ' - ' . Yii::$app->name;
$this->params['breadcrumbs'][] = '我的发布';
?>

<div class="page-header">
    <h1>我的发布</h1>
    <?= Nav::widget([
        'items' => [
            ['label' => '全部发布', 'url' => ['post/index'], 'active' => empty($_GET['type'])],
            ['label' => '文章', 'url' => ['post/index', 'type' => 'post']],
            ['label' => '问答', 'url' => ['post/index', 'type' => 'question']],
            ['label' => '话题', 'url' => ['post/index', 'type' => 'topic']],
        ],
        'options' => ['class' => 'nav nav-tabs nav-main'],
    ]); ?>
</div>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemOptions' => ['tag' => 'tr'],
    'layout' => "<table class=\"table table-striped\"><thead><tr><th>发布内容</th><th width=\"150\">时间</th></tr></thead><tbody>{items}</tbody></table>\n{pager}",
    'itemView' => function ($model, $key, $index, $widget) {
        return Html::tag('td', Html::a(Html::encode($model->item->title), $model->item->url)) . Html::tag('td', Helper::date('Y-m-d H:i', $model->item->created_at));
    },
]) ?>
