<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use frontend\widgets\Helper;
use yii\bootstrap\Nav;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '发新私信 - ' . Yii::$app->name;
$this->params['breadcrumbs'][] = ['label' => '我的私信', 'url' => ['index']];
$this->params['breadcrumbs'][] = '发新私信';
?>

<div class="page-header">
    <h1>发新私信</h1>
    <?= Html::a(Helper::icon('arrow-left') . '返回列表', ['index'], ['class' => 'btn btn-success btn-sm pull-right']) ?>
</div>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'to_id')->textInput(['maxlength' => 45]) ?>

<?= $form->field($model, 'content')->textArea(['rows' => 5]) ?>

<div class="form-group">
    <?= Html::submitButton('发送', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
