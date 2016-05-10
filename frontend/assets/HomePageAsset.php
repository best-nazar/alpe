<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class HomePageAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'css/site.css',
    ];
    public $js = [
        'js/carusel.js',
        'js/wp-embed.js',
        'js/photobox-custom.js',
        'js/envira.js',
        'js/footer-script.js',
        'js/waypoints.js',
        'js/scroll.js',
        //'js/jquery_002.js',
       // 'js/jquery_003.js',
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
