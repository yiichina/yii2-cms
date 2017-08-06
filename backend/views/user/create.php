<?php

use yiichina\adminlte\Box;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$mainTitle = '用户管理';
$subTitle = '新建用户';
$this->title = $subTitle . ' - ' . $mainTitle . ' - ' . Yii::$app->name;
$breadcrumbs[] = ['label' => $mainTitle, 'url' => ['index']];
$breadcrumbs[] = $subTitle;
$this->params = array_merge($this->params, compact('mainTitle', 'subTitle', 'breadcrumbs'));
?>
<div class="user-create">

    <?php Box::begin([
        'options' => ['class' => 'box-primary'],
        'title' => $subTitle,
    ]); ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <?php Box::end(); ?>

</div>