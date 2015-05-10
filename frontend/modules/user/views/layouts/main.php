<?php
use yii\helpers\Html;
use common\models\User;
use frontend\widgets\SideNav;

$model = User::findOne(Yii::$app->user->id);
?>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<div class="row">
    <div class="col-lg-3">
    </div>
    <div class="col-lg-9">
        <?php echo $content; ?>
    </div>
</div>
<?php $this->endContent(); ?>