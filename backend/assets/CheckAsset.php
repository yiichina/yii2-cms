<?php
namespace backend\assets;
use yii\web\AssetBundle;

class CheckAsset extends AssetBundle
{
	// The files are not web directory accessible, therefore we need
	// to specify the sourcePath property. Notice the @vendor alias used.
	public $sourcePath = '@bower/icheck';
    public $css = [
        'skins/minimal/blue.css',
    ];
    public $js = [
        'icheck.min.js',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
    ];
}
