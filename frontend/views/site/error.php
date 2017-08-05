<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yiichina\icons\Icon;

$mainTitle = $exception->statusCode . ' Error Page';
$subTitle = null;
$breadcrumbs[] = $mainTitle;
$this->params = array_merge($this->params, compact('mainTitle', 'subTitle', 'breadcrumbs'));
$textColor = $exception->statusCode === 404 ? "text-yellow" : "text-red";
?>

<div class="error-page">
    <h2 class="headline <?= $textColor ?>"> <?= $exception->statusCode ?></h2>

    <div class="error-content">
        <h3><?= Icon::show('warning', 'fa', null, ' ', ['class' => $textColor]) . nl2br(Html::encode($message)) ?></h3>

        <p>
            We could not find the page you were looking for.
            Meanwhile, you may <?= Html::a('return to dashboard', Yii::$app->homeUrl) ?> or try using the search form.
        </p>
        <?php
        echo Html::beginForm(['/site/search'], 'get', ['class' => 'search-form']);
        echo Html::tag('div', Html::textInput('q', Yii::$app->request->get('q'), ['class' => 'form-control', 'placeholder' => 'Search']) . Html::tag('div', Html::submitButton(Icon::show('search'), ['class'=>'btn btn-warning btn-flat']), ['class'=>'input-group-btn']), ['class'=>'input-group']);
        echo Html::endForm();
        ?>
    </div>
</div>
