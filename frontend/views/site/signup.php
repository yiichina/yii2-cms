<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Signup');
?>

<div class="register-box">
    <div class="register-logo"><b>会员注册</b></a></div>

    <div class="register-box-body">
        <p class="login-box-msg"><?= Yii::t('app', 'Please fill out the following fields to signup:') ?></p>

        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <?= $form->field($model, 'username', ['template' => '{input}', 'options' => ['class' => 'form-group has-feedback'], 'inputOptions' => ['type' => 'email', 'placeholder' => 'Email']])->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'email', ['template' => '{input}', 'options' => ['class' => 'form-group has-feedback'], 'inputOptions' => ['placeholder' => 'Password']])->textInput() ?>

        <?= $form->field($model, 'password', ['template' => '{input}', 'options' => ['class' => 'form-group has-feedback'], 'inputOptions' => ['type' => 'email', 'placeholder' => 'Email']])->textInput() ?>

        <?= $form->field($model, 'password_repeat', ['template' => '{input}', 'options' => ['class' => 'form-group has-feedback'], 'inputOptions' => ['placeholder' => 'Retype password']])->passwordInput() ?>

            <div class="row">
                <div class="col-xs-8">
                    <?= Html::checkbox('term', false, ['label' => Yii::t('app', 'I agree to the <a href="#">terms</a>')]) ?>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <?= Html::submitButton(Yii::t('app', 'Signup'), ['class' => 'btn btn-primary btn-block btn-flat']) ?>
                </div>
                <!-- /.col -->
            </div>
        <?php ActiveForm::end(); ?>

        <div class="social-auth-links text-center">
            <p>- OR -</p>
            <?= \yii\authclient\widgets\AuthChoice::widget([
                'baseAuthUrl' => ['site/auth'],
                'popupMode' => false,
            ]) ?>
        </div>

        <a href="login.html" class="text-center"><?= Yii::t('app', 'I already have a membership') ?></a>
    </div>
    <!-- /.form-box -->
</div>
<!-- /.register-box -->