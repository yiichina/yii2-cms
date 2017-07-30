<?php
use kartik\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\icons\Icon;
use yii\bootstrap\Nav;
use yii\bootstrap\Tabs;
use yii\helpers\Url;
use yii\authclient\widgets\AuthChoice;
use yii\web\JqueryAsset;

/**
 * @var yii\web\View $this
 */
$this->registerCssFile('@web/css/authchoice.css');
$this->registerJsFile('@web/js/authchoice.js', ['depends' => [JqueryAsset::className()]]);
$this->title = '第三方登录 - 帐户设置 - ' . Yii::$app->name;
$this->params['breadcrumbs'][] = ['label' => '帐户设置', 'url' => ['index']];
$this->params['breadcrumbs'][] = '第三方登录';
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

<div class="auth-clients user-clients">
    <ul class="auth-clients clear">
        <?php if(Yii::$app->user->identity->qq_openid): ?>
        <li class="auth-client"><a class="auth-link qq" href="/unbind?client=qq"><span class="auth-icon fa fa-qq fa-2x"></span><span class="auth-title">解绑QQ登录</span></a></li>
        <?php else: ?>
        <li class="auth-client"><a class="auth-link qq" href="/auth?authclient=qq"><span class="auth-icon fa fa-qq fa-2x"></span><span class="auth-title">绑定QQ登录</span></a></li>
        <?php endif; ?>
        <?php if(Yii::$app->user->identity->weibo_openid): ?>
        <li class="auth-client"><a class="auth-link weibo" href="/unbind?client=weibo"><span class="auth-icon fa fa-weibo fa-2x"></span><span class="auth-title">解绑微博登录</span></a></li>
        <?php else: ?>
        <li class="auth-client"><a class="auth-link weibo" href="/auth?authclient=weibo"><span class="auth-icon fa fa-weibo fa-2x"></span><span class="auth-title">绑定微博登录</span></a></li>
        <?php endif; ?>
        <?php if(Yii::$app->user->identity->github_openid): ?>
        <li class="auth-client"><a class="auth-link github" href="/unbind?client=github"><span class="auth-icon fa fa-github fa-2x"></span><span class="auth-title">解绑Github登录</span></a></li>
        <?php else: ?>
        <li class="auth-client"><a class="auth-link github" href="/auth?authclient=github"><span class="auth-icon fa fa-github fa-2x"></span><span class="auth-title">绑定Github登录</span></a></li>
        <?php endif; ?>
    </ul>
</div>