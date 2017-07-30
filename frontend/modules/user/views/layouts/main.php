<?php
use yii\helpers\Html;
use common\models\User;
use frontend\widgets\Helper;
use frontend\widgets\SideNav;

$model = User::findOne(Yii::$app->user->id);
?>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<div class="row">
    <div class="col-lg-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?= Helper::icon('user', ['class' => 'fa-fw']) ?>用户中心</h2>
            </div>
            <?= SideNav::widget([
                'items' => [
                    [
                        'url' => ['site/index'],
                        'label' => Helper::icon('cog', ['class' => 'fa-fw']).'帐户设置',
                        'active' => Yii::$app->controller->id == 'site',
                    ],
                    [
                        'url' => ['notice/index'],
                        'label' => Helper::icon('bell', ['class' => 'fa-fw']).'我的提醒',
                        'active' => Yii::$app->controller->id == 'notice',
                    ],
                    [
                        'url' => ['message/index'],
                        'label' => Helper::icon('envelope', ['class' => 'fa-fw']).'我的私信',
                        'active' => Yii::$app->controller->id == 'message',
                    ],
                    [
                        'url' => ['registration/index'],
                        'label' => Helper::icon('calendar', ['class' => 'fa-fw']).'我的签到',
                        'active' => Yii::$app->controller->id == 'registration',
                    ],
                    [
                        'url' => ['post/index'],
                        'label' => Helper::icon('list', ['class' => 'fa-fw']) . '我的发布',
                        'active' => Yii::$app->controller->id == 'post',
                    ],
                    [
                        'url' => ['favorite/index'],
                        'label' => Helper::icon('star', ['class' => 'fa-fw']).'我的收藏',
                        'active' => Yii::$app->controller->id == 'favorite',
                    ],
                    [
                        'url' => ['score/index'],
                        'label' => Helper::icon('database', ['class' => 'fa-fw']) . '我的积分',
                        'active' => Yii::$app->controller->id == 'score',
                    ],
                ],
                'encodeLabels' => false,
            ]) ?>
        </div>
    </div>
    <div class="col-lg-9">
        <?php echo $content; ?>
    </div>
</div>
<?php $this->endContent(); ?>
