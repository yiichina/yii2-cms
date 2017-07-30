<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Nav;
use yii\bootstrap\Tabs;
use frontend\assets\CropperAsset;

/**
 * @var yii\web\View $this
 */
$this->title = '修改头像 - 帐户设置 - ' . Yii::$app->name;
$this->params['breadcrumbs'][] = ['label' => '帐户设置', 'url' => ['index']];
$this->params['breadcrumbs'][] = '修改头像';

cropperAsset::register($this);
$this->registerJsFile('@web/js/cropper.js', ['depends' => CropperAsset::className()]);
?>
<div class="page-header">
    <h1>帐户设置</h1>
    <?= Nav::widget([
        'items' => [
            ['label' => '个人信息', 'url' => ['site/index']],
            ['label' => '修改头像', 'url' => ['site/avatar']],
            ['label' => '修改密码', 'url' => ['site/password']],
            ['label' => '绑定邮箱', 'url' => ['site/email']],
            ['label' => '第三方登录', 'url' => ['site/third']],
        ],
        'options' => ['class' => 'nav nav-tabs nav-main'],
    ]); ?>
</div>


<div class="row">
    <div class="col-lg-6">
        <div class="img-container">
             <?= Html::img($user->getAvatar('big') . '?' . rand(), ['id' => 'image']) ?>
        </div>
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <?= $form->field($model, 'x', ['template'=>'{input} {error}'])->hiddenInput(['id' => 'x']); ?>
        <?= $form->field($model, 'y', ['template'=>'{input}'])->hiddenInput(['id' => 'y']); ?>
        <?= $form->field($model, 'w', ['template'=>'{input}'])->hiddenInput(['id' => 'w']); ?>
        <?= $form->field($model, 'h', ['template'=>'{input}'])->hiddenInput(['id' => 'h']); ?>
        <div class="docs-buttons">
            <div class="btn-group">
                <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1" title="放大">
                    <span class="docs-tooltip" data-toggle="tooltip" title="放大">
                        <span class="fa fa-search-plus"></span>
                    </span>
                </button>
                <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1" title="缩小">
                    <span class="docs-tooltip" data-toggle="tooltip" title="缩小">
                        <span class="fa fa-search-minus"></span>
                    </span>
                </button>
            </div>

            <div class="btn-group">
                <button type="button" class="btn btn-primary" data-method="move" data-option="-10" data-second-option="0" title="左移">
                    <span class="docs-tooltip" data-toggle="tooltip" title="左移">
                        <span class="fa fa-arrow-left"></span>
                    </span>
                </button>
                <button type="button" class="btn btn-primary" data-method="move" data-option="10" data-second-option="0" title="右移">
                    <span class="docs-tooltip" data-toggle="tooltip" title="右移">
                        <span class="fa fa-arrow-right"></span>
                    </span>
                </button>
                <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="-10" title="上移">
                    <span class="docs-tooltip" data-toggle="tooltip" title="上移">
                        <span class="fa fa-arrow-up"></span>
                    </span>
                </button>
                <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="10" title="下移">
                    <span class="docs-tooltip" data-toggle="tooltip" title="下移">
                        <span class="fa fa-arrow-down"></span>
                    </span>
                </button>
            </div>

            <div class="btn-group">
                <button type="button" class="btn btn-primary" data-method="reset" title="重设">
                    <span class="docs-tooltip" data-toggle="tooltip" title="重设">
                        <span class="fa fa-refresh"></span>
                    </span>
                </button>
                <label class="btn btn-primary btn-upload" for="inputImage" title="上传头像">
                    <?= Html::activeFileInput($model, 'file', ['class' => 'sr-only', 'id' => 'inputImage', 'accept' => 'image/*']); ?>
                    <span class="docs-tooltip" data-toggle="tooltip" title="上传头像">
                        <span class="fa fa-upload"></span>
                    </span>
                </label>
                <?= Html::submitButton('<span class="fa fa-check"></span>',['class' => 'btn btn-primary'])?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <div class="col-lg-6">
        <div class="docs-preview clearfix">
            <div class="img-preview preview-lg"></div>
            <div class="img-preview preview-md"></div>
            <div class="img-preview preview-sm"></div>
        </div>
    </div>
</div>


			

