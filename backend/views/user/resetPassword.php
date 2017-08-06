<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yiichina\adminlte\Box;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$mainTitle = '用户管理';
$subTitle = '重置密码';
$this->title = $subTitle . ' - ' . $mainTitle . ' - ' . Yii::$app->name;
$breadcrumbs[] = ['label' => $mainTitle, 'url' => ['index']];
$breadcrumbs[] = $subTitle;
$this->params = array_merge($this->params, compact('mainTitle', 'subTitle', 'breadcrumbs'));
?>
<div class="user-reset-password">
    <?php Box::begin([
        'options' => ['class' => 'box-primary'],
        'title' => $subTitle,
    ]); ?>
    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'username')->textInput() ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'password_repeat')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-primary btn-flat']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Box::end(); ?>
</div>
