<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
        'css/default.css',
        'css/theme.css',
        'css/layout-responsive.css',
        'css/media-responsive.css',
        'css/animations.css',
        'css/theme-animtae.css',
        'css/spectrum.css',
        //'css/style-switcher.css',
        'css/site.css',
    ];
    public $js = [
        'js/menu.js',
        'js/theme_script.js',
        //'js/jquery-migrate.js',
        'js/jquery_002.js',
        'js/jquery_003.js',
    ];
    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD
    );
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'rmrevin\yii\fontawesome\AssetBundle',//Yii 2 Font Awesome Asset Bundle
    ];
}
