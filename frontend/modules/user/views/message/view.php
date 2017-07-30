<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use frontend\widgets\Helper;
use yii\bootstrap\Nav;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '查看私信 - ' . Yii::$app->name;
$this->params['breadcrumbs'][] = ['label' => '我的私信', 'url' => ['index']];
$this->params['breadcrumbs'][] = '查看列表';
?>

<div class="page-header">
    <h1>查看私信</h1>
    <?= Html::a(Helper::icon('arrow-left') . '返回列表', ['index'], ['class' => 'btn btn-success btn-sm pull-right']) ?>
</div>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'options' => ['tag' => 'ul', 'class' => 'media-list'],
    'itemOptions' => ['tag' => 'li', 'class' => 'media'],
    'layout' => "{items}\n{pager}",
    'itemView' => function ($model, $key, $index, $widget) {
        return Html::tag('div', Html::a(Html::img($model->sender->avatar, ['class' => 'media-object', 'alt' => $model->sender->username]), $model->sender->url, ['rel' => 'author']), ['class'=>'media-left']) . 
        Html::tag('div',
            Html::tag('div', Html::a($model->sender->username, $model->sender->url, ['rel' => 'author']) . ' 发布于 ' . Helper::date('Y-m-d H:i', $model->created_at), ['class' => 'media-heading']) .
            $model->content,
        ['class' => 'media-body']);
    },
]) ?>

<div class="page-header">
    <h2>回复私信</h2>
</div>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($message, 'parent_id', ['template'=>'{input}'])->hiddenInput(['class' => 'parent_id']) ?>
<?= $form->field($message, 'content', ['template'=>'{input}'])->textArea() ?>
<div class="form-group">
    <?= Html::submitButton(('回复'), ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>
