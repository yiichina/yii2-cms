<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Nav;
use frontend\assets\DatePickerAsset;

/**
 * @var yii\web\View $this
 */
$this->title = '个人信息 - 帐户设置 - ' . Yii::$app->name;
$this->params['breadcrumbs'][] = ['label' => '帐户设置', 'url' => ['index']];
$this->params['breadcrumbs'][] = '个人信息';

DatePickerAsset::register($this);
$this->registerJs('$("[data-provide=datepicker]").datepicker()');
?>

<div class="page-header">
    <h1>帐户设置</h1>
    <?= Nav::widget([
        'items' => [
            ['label' => '个人信息', 'url' => ['site/index']],
            ['label' => '修改头像', 'url' => ['site/avatar']],
            ['label' => '修改密码', 'url' => ['site/password']],
            ['label' => '绑定邮箱', 'url' => ['site/email']],
            ['label' => '第三方登录', 'url' => ['site/third']],
        ],
        'options' => ['class' => 'nav nav-tabs nav-main'],
    ]); ?>
</div>

<?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

<?= $form->field($model, 'email')->hint('此邮箱将被公开')->textInput(['maxlength' => 45]) ?>

<?= $form->field($model, 'nickname')->textInput(['maxlength' => 45]) ?>

<?= $form->field($model, 'gender')->inline()->radioList($model->genderList) ?>

<?= $form->field($model, 'website')->textInput(['maxlength' => 45]) ?>

<?= $form->field($model, 'qq')->textInput(['maxlength' => 45]) ?>

<?= $form->field($model, 'qq_group')->hint('验证消息：' . Yii::$app->user->id . '-' . Yii::$app->user->identity->username)->dropDownList($model->qqGroupList) ?>

<?= $form->field($model, 'github')->textInput(['maxlength' => 45]) ?>

<?= $form->field($model, 'location')->textInput(['maxlength' => 45]) ?>

<?= $form->field($model, 'school')->textInput(['maxlength' => 45]) ?>

<?= $form->field($model, 'company')->textInput(['maxlength' => 45]) ?>

<?= $form->field($model, 'birthday')->textInput(['data-provide' => 'datepicker', 'data-date-format'=>'yyyy-mm-dd', 'data-date-language' => 'zh-CN', 'readonly' => 'readonly']); ?>

<?= $form->field($model, 'signature')->textArea(['maxlength' => 45]) ?>


<div class="form-group">
    <div class="col-sm-3"></div>
    <div class="col-sm-6"><?= Html::submitButton('修改', ['class' => 'btn btn-primary']) ?></div>
</div>

<?php ActiveForm::end(); ?>
