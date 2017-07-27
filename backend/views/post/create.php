<?php

use yii\helpers\Html;
use yiichina\adminlte\Box;
use yiichina\icons\Icon;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$mainTitle = '内容管理';
$subTitle = '新建文章';
$this->title = $subTitle . ' - ' . $mainTitle . ' - ' . Yii::$app->name;
$breadcrumbs[] = ['label' => $mainTitle, 'url' => ['index']];
$breadcrumbs[] = $subTitle;
$this->params = array_merge($this->params, compact('mainTitle', 'subTitle', 'breadcrumbs'));
?>
<div class="post-create">
    <?php Box::begin([
        'options' => ['class' => 'box-primary'],
        'title' => $subTitle,
    ]); ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <?php Box::end(); ?>
</div>
