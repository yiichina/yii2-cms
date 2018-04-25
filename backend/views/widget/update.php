<?php

use yiichina\adminlte\Box;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$mainTitle = '模板管理';
$subTitle = '修改模板';
$this->title = $subTitle . ' - ' . $mainTitle . ' - ' . Yii::$app->name;
$breadcrumbs[] = ['label' => $mainTitle, 'url' => ['index']];
$breadcrumbs[] = $subTitle;
$this->params = array_merge($this->params, compact('mainTitle', 'subTitle', 'breadcrumbs'));
?>
<div class="template-update">
    <?php Box::begin([
        'options' => ['class' => 'box-primary'],
        'title' => $subTitle,
    ]); ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <?php Box::end(); ?>
</div>
