<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yiichina\select2\Select2;
use yiichina\icheck\ICheck;
use yiichina\icons\Icon;
use common\models\Node;

/* @var $this yii\web\View */
/* @var $model common\models\Node */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sensitive-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'node_id')->widget(Select2::className(), ['items' => Node::getItems(), 'bootstrapTheme' => true, 'clientOptions' => ['width' => '100%']]) ?>

    <?= $form->field($model, 'words')->textInput() ?>

    <?= $form->field($model, 'status')->widget(ICheck::className(), ['type' => ICheck::TYPE_RADIO_LIST, 'items' => $model->statusList]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Icon::show('plus') . Yii::t('app', 'Create') : Icon::show('edit') . Yii::t('app', 'Reset'), ['class' => $model->isNewRecord ? 'btn btn-success btn-flat' : 'btn btn-primary btn-flat']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
