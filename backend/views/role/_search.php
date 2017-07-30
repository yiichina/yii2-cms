<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Node;

/* @var $this yii\web\View */
/* @var $model common\models\NodeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="node-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'parent_id', ['template' => '{input}', 'inputOptions' => ['class' => 'form-control input-sm']])->dropDownList($model->parentList, ['prompt' => '请选择父栏目']) ?>
        </div>

        <div class="col-xs-3">
            <?= $form->field($model, 'name', ['template' => '{input}', 'inputOptions' => ['class' => 'form-control input-sm']])->textInput(['placeholder' => $model->getAttributeLabel('name')]) ?>
        </div>

        <div class="col-xs-3">
            <?= $form->field($model, 'status', ['wrapperOptions' => ['style' => 'display:inline-block']])->inline()->radioList($model->statusList) ?>
        </div>

        <div class="col-xs-3">
            <div class="form-group pull-right">
                <?= Html::submitButton('搜索', ['class' => 'btn btn-primary btn-sm btn-flat']) ?>
                <?= Html::resetButton('重置', ['class' => 'btn btn-default btn-sm btn-flat']) ?>
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
