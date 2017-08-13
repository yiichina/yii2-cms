<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Node;

/* @var $this yii\web\View */
/* @var $model common\models\GroupSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="node-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">

        <div class="col-xs-3">
            <?= $form->field($model, 'node_ids', ['template' => '{input}', 'inputOptions' => ['class' => 'form-control input-sm']])->textInput() ?>
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
