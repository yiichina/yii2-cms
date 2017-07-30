<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Nav;
use yii\widgets\ListView;
use frontend\widgets\Helper;

/**
 * @var yii\web\View $this
 */
$this->title = '我的积分 - ' . Yii::$app->name;
$this->params['breadcrumbs'][] = '我的积分';
?>

<div class="page-header">
    <h1>我的积分</h1>
</div>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemOptions' => ['tag' => 'tr'],
    'layout' => "<table class=\"table table-striped\"><thead><tr><th>积分变化说明</th><th width=\"100\">金钱</th><th width=\"100\">威望</th><th width=\"150\">时间</th></tr></thead><tbody>{items}</tbody></table>\n{pager}",
    'itemView' => function ($model, $key, $index, $widget) {
        return Html::tag('td', $model->content) . Html::tag('td', $model->money) . Html::tag('td', $model->prestige) . Html::tag('td', Helper::date('Y-m-d H:i', $model->created_at));
    },
]) ?>
