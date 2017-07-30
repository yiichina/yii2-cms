<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;
use frontend\widgets\Helper;
use frontend\widgets\Follow;
use frontend\widgets\Message;
use yii\bootstrap\Progress;

$id = isset($_GET['id']) ? $_GET['id'] : Yii::$app->user->id;
$self = Yii::$app->user->id == $id;

$model = User::findOne($id);
$follow = $model->getFans()->where(['fans_id'=>$id])->orderBy('created_at DESC')->limit(25)->all();
$fans = $model->getFollows()->where(['user_id'=>$id])->orderBy('created_at DESC')->limit(25)->all();
$visit = $model->getVisits()->where(['user_id'=>$id])->orderBy('created_at DESC')->limit(5)->all();
?>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<div class="row">
    <div class="col-lg-3">
        <div class="panel panel-default">
            <div class="panel-body" style="background: url(http://www.yiichina.com/images/user-bg.jpg); background-size:100% 120px; background-repeat:no-repeat;">
                <div class="user">
                    <?= $self ? Html::a(Html::img($model->getAvatar('middle'), ['alt' => $model->username, 'class' => 'avatar']), ['/user/site/avatar'], ['data-toggle' => 'tooltip', 'title' => '点击修改头像']) : Html::img($model->getAvatar('middle'), ['alt' => $model->username, 'class' => 'avatar']) ?>
                    <h1>
                        <?= $model->id . '-' . $model->username ?>
                        <?php if(!empty($model->nickname)): ?>
                        <small>（<?= $model->profile->nickname ?>）</small>
                        <?php endif; ?>
                    </h1>
                    <p><?= empty($model->profile->signature) ? '这家伙有点懒，还没写个性签名！' : Html::encode($model->profile->signature) ?></p>
                    <?php if(!$self): ?>
                    <div class="button"><?= Follow::widget(['id' => $model->id]) . Message::widget(['id' => $model->id]) ?></div>
                    <?php endif; ?>
                    <ul class="stat">
                        <li>财富值<h3><?= $model->money ?></h3></li>
                        <li>威望值<h3><?= $model->prestige ?></h3></li>
                        <li>总积分<h3><?= $model->score ?></h3></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">个人信息</h2>
                <span class="pull-right"><?= Html::a(Helper::icon('cog'), ['/user/site/index'], ['data-toggle' => 'tooltip', 'title' => '帐户设置', 'class' => 'btn btn-xs']) ?></span>
            </div>
            <div class="panel-body">
                <ul class="user-info">
                    <li><?= Helper::icon('calendar', ['class' => 'fa-fw']) ?>注册日期：<?= Helper::date('Y-m-d', $model->created_at) ?></li>
                    <li><?= Helper::icon('sign-in', ['class' => 'fa-fw']) ?>最后登录：<?= Helper::date('Y-m-d H:i', $model->login_time) ?></li>
                    <li><?= Helper::icon('clock-o', ['class' => 'fa-fw']) ?>在线时长：<?= $model->onlineTime ?></li>
                    <li><?= Helper::icon('map-marker', ['class' => 'fa-fw']) . (empty($model->profile->location) ?  '未设置' : $model->profile->location) ?></li>
                    <?php if(!empty($model->profile->birthday)): ?>
                    <li><?= Helper::icon('birthday-cake', ['class' => 'fa-fw']) . $model->profile->birthday ?></li>
                    <?php endif; ?>
                    <?php if(!empty($model->profile->school)): ?>
                    <li><?= Helper::icon('university', ['class' => 'fa-fw']) . $model->profile->school ?></li>
                    <?php endif; ?>
                    <?php if(!empty($model->profile->company)): ?>
                    <li><?= Helper::icon('suitcase', ['class' => 'fa-fw']) . $model->profile->company ?></li>
                    <?php endif; ?>
					<?php if(!empty($model->profile->email)): ?>
                    <li><?= Helper::icon('envelope-o', ['class' => 'fa-fw']) . $model->profile->email ?></li>
					<?php endif; ?>
                    <li><?= Helper::icon('group', ['class' => 'fa-fw']) . $model->profile->qqGroupLink ?></li>
                    <?php if(!empty($model->profile->website)): ?>
                    <li><?= Helper::icon('link', ['class' => 'fa-fw']) . $model->profile->website ?></li>
                    <?php endif; ?>
                    <?php if(!empty($model->profile->github)): ?>
                    <li><?= Helper::icon('github', ['class' => 'fa-fw']) . Html::a($model->profile->github, 'https://github.com/' . $model->profile->github, ['target' => '_blank']) ?></li>
                    <?php endif; ?>
                <ul>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <?php echo $content; ?>
    </div>
    <div class="col-lg-3">
        <p>
            <span style="color: #D8582B; font-weight: bold;"><?= $model->level['title'] ?></span>
            <span class="pull-right"><?= Html::a('查看等级规则', ['/site/page', 'view' => 'rule']) ?> | <?= Html::a('排行榜', ['/site/top']) ?></span>
        </p>
        <?= Progress::widget([
            'percent' => ($model->score / $model->level['max']) * 100,
            'barOptions' => ['class' => 'progress-bar-success'],
            'label' => $model->score . '/' . $model->level['max'],
        ]); ?>

        <?= Progress::widget([
            'percent' => ($model->score / $model->level['max']) * 100,
            'barOptions' => ['class' => 'progress-bar-info'],
            'label' => $model->score . '/' . $model->level['max'],
        ]); ?>

        <?= Progress::widget([
            'percent' => ($model->score / $model->level['max']) * 100,
            'barOptions' => ['class' => 'progress-bar-warning'],
            'label' => $model->score . '/' . $model->level['max'],
        ]); ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?= $self ? '我' : 'Ta' ?>的关注 <span class="badge"><?= $model->getFans()->count() ?></span></h2>
                <span class="pull-right"><?= Html::a('所有关注&raquo;', ['default/follow', 'id'=>$model->id], ['class' => 'btn btn-xs']) ?></span>
            </div>
            <div class="panel-body">
                <ul class="avatar-list">
                    <?php foreach($follow as $data): ?>
                    <li><?= Html::a(Html::img($data->user->avatar), $data->user->url, ['rel' => 'author']) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?= $self ? '我' : 'Ta' ?>的粉丝 <span class="badge"><?= $model->getFollows()->count() ?></span></h2>
                <span class="pull-right"><?= Html::a('所有粉丝&raquo;', ['default/fans', 'id'=>$model->id], ['class' => 'btn btn-xs']) ?></span>
            </div>
            <div class="panel-body">
                <ul class="avatar-list">
                    <?php foreach($fans as $data): ?>
                    <li><?= Html::a(Html::img($data->fans->avatar), $data->fans->url, ['rel' => 'author']) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">最近访客</h2>
                <span class="pull-right"><?= Html::a('所有访客&raquo;', ['default/visit', 'id'=>$model->id], ['class' => 'btn btn-xs']) ?></span>
            </div>
            <div class="panel-body">
                <ul class="media-list">
                    <?php foreach($visit as $data): ?>
                    <li class="media">
                        <div class="media-left">
                            <?= Html::a(Html::img($data->caller->avatar, ['class' => 'media-object', 'alt' => $data->caller->username]), $data->caller->url, ['rel' => 'author']) ?>
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading"><?= Html::a($data->caller->username, $data->caller->url, ['rel' => 'author']) ?></h3>
                            <div class="media-action"><?= Helper::date('Y-m-d H:i', $data->created_at) ?></div>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

    </div>
</div>
<?php $this->endContent(); ?>
