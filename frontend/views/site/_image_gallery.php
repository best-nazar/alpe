<?php
/**
 * Image Gallery View
 */
use yii\helpers\Url;

$photoItems = [];

foreach ($model->images as $images){
    $photoItems[] = [
        'url' => Url::to('/images/'.$model->id.'/'.$images->file_name, true),
        'src' => Url::to('/images/'.$model->id.'/'.$images->file_name, true),
        'options' => array('title' => $model->name)
    ];
};
/**
$items = [
    [
        'url' => 'http://farm8.static.flickr.com/7429/9478294690_51ae7eb6c9_b.jpg',
        'src' => 'http://farm8.static.flickr.com/7429/9478294690_51ae7eb6c9_s.jpg',
        'options' => array('title' => 'Camposanto monumentale (inside)')
    ],

];*/
?>
<?= dosamigos\gallery\Gallery::widget(['items' => $photoItems]);?>