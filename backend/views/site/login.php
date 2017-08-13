<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Spaceless;
use backend\assets\AppAsset;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition login-page">
<?php $this->beginBody() ?>
<?php Spaceless::begin(); ?>
<div class="login-box">
    <div class="login-logo"><b>Yii CMS</b> 后台管理系统</div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <?= $form->field($model, 'username', ['template' => '{input}', 'inputOptions' => ['placeholder' => 'Email']])->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password', ['template' => '{input}', 'inputOptions' => ['placeholder' => 'Password']])->passwordInput() ?>

        <div class="row">
            <div class="col-xs-8">
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </div>
            <div class="col-xs-4">
                <?= Html::submitButton('Sign In', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<?php Spaceless::end(); ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
