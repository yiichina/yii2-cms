<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yiichina\select2\Select2;
use yiichina\icons\Icon;
use common\models\Node;

/* @var $this yii\web\View */
/* @var $model common\models\Node */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="node-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'node_ids')->widget(Select2::className(), ['items' => Node::getItems(), 'bootstrapTheme' => true, 'multiple' => true, 'clientOptions' => ['width' => '100%']]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Icon::show('plus') . Yii::t('app', 'Create') : Icon::show('edit') . Yii::t('app', 'Reset'), ['class' => $model->isNewRecord ? 'btn btn-success btn-flat' : 'btn btn-primary btn-flat']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
