<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yiichina\icons\Icon;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($post, 'title')->textInput() ?>

    <?= $form->field($model, 'flv')->textInput() ?>

    <?= $form->field($post, 'tags')->textInput() ?>

    <?= $form->field($post, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Icon::show('plus') . Yii::t('app', 'Create') : Icon::show('edit') . Yii::t('app', 'Reset'), ['class' => $model->isNewRecord ? 'btn btn-success btn-flat' : 'btn btn-primary btn-flat']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
