<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Nav;
use yii\widgets\ListView;
use frontend\widgets\Helper;
use frontend\widgets\Calendar;

/**
 * @var yii\web\View $this
 */
$this->title = '我的签到 - ' . Yii::$app->name;
$this->params['breadcrumbs'][] = '我的签到';
?>

<div class="page-header">
    <h1>我的签到</h1>
</div>

<div class="row">
	<div class="col-lg-7">
		<?= Calendar::widget() ?>
	</div>
	<div class="col-lg-5">
        <div class="page-header">
            <h2>签到统计</h2>
        </div>
        <ul>
		    <li>总计签到天数：<?= $count ?>天</li>
			<li>最高连续签到：<?= $most_continuous ?>天</li>
		    <li>当前连续签到：<?= $current_continuous ?>天</li>
        </ul>
        <div class="page-header">
            <h2>补签卡统计</h2>
        </div>
        <ul>
            <li>获赠补签卡数量：<?= $card_total ?>张</li>
            <li>已用补签卡数量：<?= $card_used ?>张</li>
            <li>可用补签卡数量：<?= $card_total - $card_used ?>张</li>
        </ul>
        <p class="bg-info">补签说明：只能补签近3天内且前一天签到的日期</p>
	</div>
</div>
<div class="page-header">
    <h2>补签卡获赠记录</h2>
</div>
<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemOptions' => ['tag' => 'tr'],
    'layout' => "<table class=\"table table-striped\"><thead><tr><th>补签卡说明</th><th width=\"150\">获赠时间</th></tr></thead><tbody>{items}</tbody></table>\n{pager}",
    'itemView' => function ($model, $key, $index, $widget) {
        return Html::tag('td', Html::encode($model->content)) . Html::tag('td', Helper::date('Y-m-d H:i', $model->created_at));
    },
]) ?>

