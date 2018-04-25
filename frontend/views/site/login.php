<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Login');
?>

<div class="login-box">
    <div class="login-logo"><b>会员登录</b></div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <?= $form->field($model, 'username', ['template' => '{input}', 'inputOptions' => ['placeholder' => 'Username/Email']])->textInput() ?>

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

        <div class="social-auth-links text-center">
            <p>- OR -</p>
            <?= \yii\authclient\widgets\AuthChoice::widget([
                'baseAuthUrl' => ['site/auth'],
                'popupMode' => false,
            ]) ?>
        </div>
        <!-- /.social-auth-links -->

        <?= Html::a(Yii::t('app', 'I forgot my password'), ['site/request-password-reset']) ?><br>
        <?= Html::a(Yii::t('app', 'Register a new membership'), ['site/signup']) ?></a>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->