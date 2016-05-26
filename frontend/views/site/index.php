<?php

use frontend\assets\HomePageAsset;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $tizer */
/* @var $weRecommend */
/* @var $avtoCharter */
/* @var $aviaCharter */


$this->title = 'AlpeAdria Tour';
HomePageAsset::register($this);
?>
        <div class="col-sm-8">

            <div id="myCarousel" class="carousel slide" data-ride="carousel" data-pause="false" data-interval="5000">
                <div class="carousel-inner">
                    <?php $i=0; foreach ($tizer as $obj) { ;?>
                    <div class="item <?php if ($i==0) print 'active';?>">
                        <img src="/images/<?=$obj->id?>/<?=$obj->main_image?>" alt="<?=$obj->name?>" style="width: 1400px; height: 470px">
                        <div class="container">
                            <div class="carousel-caption">
                                <div class="carousel-text">
                                    <h1 class="animated bounceInRight"><a href="<?=Url::to(['site/show-product','id'=>$obj->id])?>" ><?=$obj->name?></a></h1>
                                    <ul class="list-unstyled carousel-list">
                                        <li title="" data-original-title="" class="animated bounceInLeft">
                                            <?=$obj->country0->name?>,
                                            <?=$obj->price?>&nbsp;
                                            <?=$obj->currency0->code?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $i++; } ?>
                    </div>
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li title="" data-original-title="" data-target="#myCarousel" data-slide-to="0" class=""></li>
                    <li class="" title="" data-original-title="" data-target="#myCarousel" data-slide-to="1"></li>
                    <li class="active" title="" data-original-title="" data-target="#myCarousel" data-slide-to="2"></li>
                </ol>
            </div><!-- /.carousel -->
            <div class="enigma_blog_area ">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="enigma_heading_title">
                            <h3>Рекоменндуємо</h3>
                        </div>
                    </div>
                </div>

                <!-- recommends-->
                <div style="display: block; text-align: start; float: none; position: relative; top: auto; right: auto; bottom: auto; left: auto; z-index: auto; width: auto; height: auto; margin: 0px; overflow: hidden;" class="caroufredsel_wrapper">
                    <?php foreach ($weRecommend as $obj) { ?>
                    <div class="col-md-4 col-sm-12 scrollimation scale-in d2 pull-left" style="width: 100%">
                        <div class="enigma_blog_thumb_wrapper">
                            <div class="enigma_blog_thumb_wrapper_showcase">
                                <img src="/images/<?=$obj->id?>/<?=$obj->main_image?>" class="enigma_img_responsive wp-post-image" alt="portfolio-5">
                                <div class="enigma_blog_thumb_wrapper_showcase_overlay">
                                    <div class="enigma_blog_thumb_wrapper_showcase_overlay_inner ">
                                        <div class="enigma_blog_thumb_wrapper_showcase_icons">
                                            <a title="Переглянути" href="<?=Url::to(['site/show-product','id'=>$obj->id])?>"><i class="fa fa-link"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h2><a href="<?=Url::to(['site/show-product','id'=>$obj->id])?>"><?=$obj->name?></a></h2>
                            <i class="fa fa-angle-double-right"></i>
                            <a href="<?=Url::to(['site/show-product','id'=>$obj->id])?>"><?=$obj->country0->name?></a>

                            <p><?=$obj->short_desc?></p>
                            <hr style="margin: 0">
                            <div class="enigma_blog_thumb_footer">
                                <ul class="enigma_blog_thumb_date">
                                    <li title="" data-original-title=""><i class="fa fa-money"></i>
                                        <a href="<?=Url::to(['site/show-product','id'=>$obj->id])?>"><?=$obj->price?>&nbsp;<?=$obj->currency0->code?></a>
                                    </li>
                                    <li title="" data-original-title=""><i class="fa fa-clock-o"></i>
                                        <?=Yii::$app->formatter->asDate(\common\models\helper::productStartDate($obj))?>
                                    </li>
                                </ul>
                            </div>
                            <a href="<?=Url::to(['site/show-product','id'=>$obj->id])?>" class="enigma_blog_read_btn"><i class="fa fa-plus-circle"></i>Дізнатись більше</a>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <!-- recommends-->
            </div>
        </div> <!-- One of three columns -->
<div class="col-sm-2">
    <!-- side widget-->
    <div class="enigma_sidebar_widget">
        <div class="enigma_sidebar_widget_title"><h2>Автобусні чартери</h2></div>
        <?php foreach($avtoCharter as $obj) { ?>
            <div class="media enigma_recent_widget_post">
                <a title="Переглянути" href="#" class="enigma_recent_widget_post_move">
                    <img width="64" height="64" alt="portfolio-5" class="enigma_recent_widget_post_img wp-post-image"
                         src="/images/<?=$obj->id?>/<?=$obj->main_image?>">
                </a>
                <div class="media-body">
                    <h3><a href="#"><?=$obj->name?></a></h3>
                    <span class="enigma_recent_widget_post_date"><?=$obj->created_at?></span>
                </div>
            </div>
        <?php } ?>
        <a href="#" class="enigma_blog_read_btn"><i class="fa fa-plus-circle"></i>Більше...</a>
    </div>

    <div class="enigma_sidebar_widget">
        <div class="enigma_sidebar_widget_title"><h2>Авіа чартери</h2></div>
        <?php foreach($aviaCharter as $obj) { ?>
            <div class="media enigma_recent_widget_post">
                <a title="Hello world!" href="#" class="enigma_recent_widget_post_move">
                    <img width="64" height="64" alt="portfolio-5" class="enigma_recent_widget_post_img wp-post-image"
                         src="/images/<?=$obj->id?>/<?=$obj->main_image?>">
                </a>
                <div class="media-body">
                    <h3><a href="#"><?=$obj->name?></a></h3>
                    <span class="enigma_recent_widget_post_date"><?=$obj->id?></span>
                </div>
            </div>
        <?php } ?>
        <a href="#" class="enigma_blog_read_btn"><i class="fa fa-plus-circle"></i>Більше...</a>
    </div>
    <!-- side widget-->
    <!-- weather widget -->

    <!-- weather widget -->
</div>