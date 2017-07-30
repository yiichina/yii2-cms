<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\widgets\ListView;
use yii\widgets\DetailView;
use frontend\widgets\Helper;

$this->title = $user->username . ' - 个人主页 - ' . Yii::$app->name;
$this->params['breadcrumbs'][] = '个人主页';
?>

<?= Nav::widget([
    'items' => [
        ['label' => '全部动态', 'url' => ['default/index', 'id'=>$user->id], 'active'=> empty($_GET['type'])],
        ['label' => '说说', 'url' => ['default/index', 'id'=>$user->id, 'type'=>'feed']],
        ['label' => '文章', 'url' => ['default/index', 'id'=>$user->id, 'type'=>'post']],
        ['label' => '问答', 'url' => ['default/index', 'id'=>$user->id, 'type'=>'question']],
        ['label' => '话题', 'url' => ['default/index', 'id'=>$user->id, 'type'=>'topic']],
        ['label' => '案例', 'url' => ['default/index', 'id'=>$user->id, 'type'=>'case']],
    ],
    'options' => ['class' => 'nav nav-tabs nav-user',],
]) ?>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'options' => ['tag' => 'ul', 'class' => 'media-list'],
    'itemOptions' => ['tag' => 'li', 'class' => 'media'],
    'layout' => "{items}\n{pager}",
    'itemView' => function ($model, $key, $index, $widget) {
        return $model->media;
    },
]) ?>
