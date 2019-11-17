<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yiichina\icheck\ICheck;

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
            <?= $form->field($model, 'status', ['wrapperOptions' => ['style' => 'display:inline-block']])->inline()->radioList($model->statusList) ?>
        </div>

        <div class="col-xs-3">
            <div class="form-group pull-right">
                <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary btn-sm btn-flat']) ?>
                <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default btn-sm btn-flat']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
