<?php

use yiichina\adminlte\Box;

/* @var $this yii\web\View */
/* @var $model common\models\Node */

$mainTitle = '栏目管理';
$subTitle = '修改栏目';
$this->title = $subTitle . ' - ' . $mainTitle . ' - ' . Yii::$app->name;
$breadcrumbs[] = ['label' => $mainTitle, 'url' => ['index']];
$breadcrumbs[] = $subTitle;
$this->params = array_merge($this->params, compact('mainTitle', 'subTitle', 'breadcrumbs'));
?>
<div class="node-update">

    <?php Box::begin([
        'options' => ['class' => 'box-primary'],
        'title' => $subTitle,
    ]); ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <?php Box::end(); ?>

</div>
