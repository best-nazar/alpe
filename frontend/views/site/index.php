<?php

use frontend\assets\HomePageAsset;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
HomePageAsset::register($this);
?>
<!-- Carousel -->
    <div class="row">
        <div class="col-sm-2">
            <div class="enigma_heading_title">
                <h4>Тури по країнах</h4>
            </div>
            <nav>
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="#">Албанія<span class="al"></span></a></li>
                    <li><a href="#">Греція<span class="gr"></span></a></li>
                    <li><a href="#">Хорватія<span class="hr"></span></a></li>
                    <li><a href="#">Чорногорія<span class="mn"></span></a></li>
                </ul>
            </nav>
        </div>
        <div class="col-sm-8">
            <div id="myCarousel" class="carousel slide" data-ride="carousel" data-pause="false" data-interval="5000">

                <div class="carousel-inner">
                    <div class="item">
                        <img src="/images/slider-bg-33.jpg">
                        <div class="container">
                            <div class="carousel-caption">
                                <div class="carousel-text">
                                    <h1 class="animated bounceInRight"><a href="#" >Шикарний готель</a></h1>
                                    <ul class="list-unstyled carousel-list">
                                        <li title="" data-original-title="" class="animated bounceInLeft">Єгипет, 250Є</li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="item">
                        <img src="/images/slider-bg-22.jpg">
                        <div class="container">
                            <div class="carousel-caption">
                                <div class="carousel-text">
                                    <h1 class="animated bounceInRight"><a href="#" >Суперовий готель</a></h1>
                                    <ul class="list-unstyled carousel-list">
                                        <li title="" data-original-title="" class="animated bounceInLeft">Албанія, 375Є</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item active">
                        <img src="/images/slider-bg-11.jpg">
                        <div class="container">
                            <div class="carousel-caption">
                                <div class="carousel-text">
                                    <h1 class="animated bounceInRight"><a href="#" >Груповий яхтинг</a></h1>
                                    <ul class="list-unstyled carousel-list">
                                        <li title="" data-original-title="" class="animated bounceInLeft">Чорногорія, 500Є</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
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

                    <div class="col-md-4 col-sm-12 scrollimation scale-in d2 pull-left" style="width: 100%">
                        <div class="enigma_blog_thumb_wrapper">
                            <div class="enigma_blog_thumb_wrapper_showcase">
                                <img src="/images/portfolio-5-340x210.jpg" class="enigma_img_responsive wp-post-image" alt="portfolio-5">
                                <div class="enigma_blog_thumb_wrapper_showcase_overlay">
                                    <div class="enigma_blog_thumb_wrapper_showcase_overlay_inner ">
                                        <div class="enigma_blog_thumb_wrapper_showcase_icons">
                                            <a title="Hello world!" href="#"><i class="fa fa-link"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h2><a href="#">Назва туру 1</a></h2>
                            <i class="fa fa-angle-double-right"></i>
                            <a href="#">Албанія</a>

                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                                diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam
                                erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et
                                ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem
                                ipsum dolor sit amet. Lorem ipsum dolor sit amet,</p>
                            <hr style="margin: 0">
                            <div class="enigma_blog_thumb_footer">
                                <ul class="enigma_blog_thumb_date">
                                    <li title="" data-original-title=""><i class="fa fa-money"></i><a href="#">150 &euro;</a></li>
                                    <li title="" data-original-title=""><i class="fa fa-clock-o"></i>25 липня 2016</li>
                                </ul>
                            </div>
                            <a href="#" class="enigma_blog_read_btn"><i class="fa fa-plus-circle"></i>Дізнатись більше</a>
                        </div>
                    </div>
                </div>
                <!-- recommends-->
                <!-- recommends-->
                <div style="display: block; text-align: start; float: none; position: relative; top: auto; right: auto; bottom: auto; left: auto; z-index: auto; width: auto; height: auto; margin: 0px; overflow: hidden;" class="caroufredsel_wrapper">

                    <div class="col-md-4 col-sm-12 scrollimation scale-in d2 pull-left" style="width: 100%">
                        <div class="enigma_blog_thumb_wrapper">
                            <div class="enigma_blog_thumb_wrapper_showcase">
                                <img src="Weblizar_files/portfolio-5-340x210.jpg" class="enigma_img_responsive wp-post-image" alt="portfolio-5">
                                <div class="enigma_blog_thumb_wrapper_showcase_overlay">
                                    <div class="enigma_blog_thumb_wrapper_showcase_overlay_inner ">
                                        <div class="enigma_blog_thumb_wrapper_showcase_icons">
                                            <a title="Hello world!" href="#"><i class="fa fa-link"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h2><a href="#">Назва туру 1</a></h2>
                            <i class="fa fa-angle-double-right"></i>
                            <a href="#">Албанія</a>

                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                                diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam
                                erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et
                                ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem
                                ipsum dolor sit amet. Lorem ipsum dolor sit amet,</p>
                            <hr style="margin: 0">
                            <div class="enigma_blog_thumb_footer">
                                <ul class="enigma_blog_thumb_date">
                                    <li title="" data-original-title=""><i class="fa fa-money"></i><a href="#">150 &euro;</a></li>
                                    <li title="" data-original-title=""><i class="fa fa-clock-o"></i>25 липня 2016</li>
                                </ul>
                            </div>
                            <a href="#" class="enigma_blog_read_btn"><i class="fa fa-plus-circle"></i>Дізнатись більше</a>
                        </div>
                    </div>
                </div>
                <!-- recommends-->
                <!-- recommends-->
                <div style="display: block; text-align: start; float: none; position: relative; top: auto; right: auto; bottom: auto; left: auto; z-index: auto; width: auto; height: auto; margin: 0px; overflow: hidden;" class="caroufredsel_wrapper">

                    <div class="col-md-4 col-sm-12 scrollimation scale-in d2 pull-left" style="width: 100%">
                        <div class="enigma_blog_thumb_wrapper">
                            <div class="enigma_blog_thumb_wrapper_showcase">
                                <img src="Weblizar_files/portfolio-5-340x210.jpg" class="enigma_img_responsive wp-post-image" alt="portfolio-5">
                                <div class="enigma_blog_thumb_wrapper_showcase_overlay">
                                    <div class="enigma_blog_thumb_wrapper_showcase_overlay_inner ">
                                        <div class="enigma_blog_thumb_wrapper_showcase_icons">
                                            <a title="Hello world!" href="#"><i class="fa fa-link"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h2><a href="#">Назва туру 1</a></h2>
                            <i class="fa fa-angle-double-right"></i>
                            <a href="#">Албанія</a>

                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                                diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam
                                erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et
                                ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem
                                ipsum dolor sit amet. Lorem ipsum dolor sit amet,</p>
                            <hr style="margin: 0">
                            <div class="enigma_blog_thumb_footer">
                                <ul class="enigma_blog_thumb_date">
                                    <li title="" data-original-title=""><i class="fa fa-money"></i><a href="#">150 &euro;</a></li>
                                    <li title="" data-original-title=""><i class="fa fa-clock-o"></i>25 липня 2016</li>
                                </ul>
                            </div>
                            <a href="#" class="enigma_blog_read_btn"><i class="fa fa-plus-circle"></i>Дізнатись більше</a>
                        </div>
                    </div>
                </div>
                <!-- recommends-->
            </div>


        </div> <!-- One of three columns -->
        <div class="col-sm-2">
            <!-- side widget-->
            <div class="enigma_sidebar_widget">
                <div class="enigma_sidebar_widget_title"><h2>Автобусні чартери</h2></div>
                <div class="media enigma_recent_widget_post">
                    <a title="Hello world!" href="#" class="enigma_recent_widget_post_move">
                        <img width="64" height="64" alt="portfolio-5" class="enigma_recent_widget_post_img wp-post-image" src="http://demo.weblizar.com/enigma-premium/wp-content/uploads/sites/23/2014/07/portfolio-5-64x64.jpg">
                    </a>
                    <div class="media-body">
                        <h3><a href="#"> Чартер Чорногорія</a></h3>
                        <span class="enigma_recent_widget_post_date">7 березня 2016</span>
                    </div>
                </div>

                <div class="media enigma_recent_widget_post">
                    <a title="Hello world!" href="#" class="enigma_recent_widget_post_move">
                        <img width="64" height="64" alt="portfolio-5" class="enigma_recent_widget_post_img wp-post-image" src="http://demo.weblizar.com/enigma-premium/wp-content/uploads/sites/23/2014/07/portfolio-5-64x64.jpg">
                    </a>
                    <div class="media-body">
                        <h3><a href="#"> Чартер Хорватія</a></h3>
                        <span class="enigma_recent_widget_post_date">7 березня 2016</span>
                    </div>
                </div>

                <div class="media enigma_recent_widget_post">
                    <a title="Hello world!" href="#" class="enigma_recent_widget_post_move">
                        <img width="64" height="64" alt="portfolio-5" class="enigma_recent_widget_post_img wp-post-image" src="http://demo.weblizar.com/enigma-premium/wp-content/uploads/sites/23/2014/07/portfolio-5-64x64.jpg">
                    </a>
                    <div class="media-body">
                        <h3><a href="#"> Чартер Албанія</a></h3>
                        <span class="enigma_recent_widget_post_date">7 березня 2016</span>
                    </div>
                </div>
                <a href="#" class="enigma_blog_read_btn"><i class="fa fa-plus-circle"></i>Дізнатись більше</a>
            </div>
            <!-- side widget-->
            <!-- side widget-->
            <div class="enigma_sidebar_widget">
                <div class="enigma_sidebar_widget_title"><h2>Авіа чартери</h2></div>
                <div class="media enigma_recent_widget_post">
                    <a title="Hello world!" href="#" class="enigma_recent_widget_post_move">
                        <img width="64" height="64" alt="portfolio-5" class="enigma_recent_widget_post_img wp-post-image" src="http://demo.weblizar.com/enigma-premium/wp-content/uploads/sites/23/2014/07/img-11.jpg">
                    </a>
                    <div class="media-body">
                        <h3><a href="#"> Авіа чартер Чорногорія</a></h3>
                        <span class="enigma_recent_widget_post_date">7 березня 2016</span>
                    </div>
                </div>

                <div class="media enigma_recent_widget_post">
                    <a title="Hello world!" href="#" class="enigma_recent_widget_post_move">
                        <img width="64" height="64" alt="portfolio-5" class="enigma_recent_widget_post_img wp-post-image" src="http://demo.weblizar.com/enigma-premium/wp-content/uploads/sites/23/2014/07/img-11.jpg">
                    </a>
                    <div class="media-body">
                        <h3><a href="#"> Авіа чартер Хорватія</a></h3>
                        <span class="enigma_recent_widget_post_date">7 березня 2016</span>
                    </div>
                </div>

                <div class="media enigma_recent_widget_post">
                    <a title="Hello world!" href="#" class="enigma_recent_widget_post_move">
                        <img width="64" height="64" alt="portfolio-5" class="enigma_recent_widget_post_img wp-post-image" src="http://demo.weblizar.com/enigma-premium/wp-content/uploads/sites/23/2014/07/img-11.jpg">
                    </a>
                    <div class="media-body">
                        <h3><a href="#"> Авіа чартер Албанія</a></h3>
                        <span class="enigma_recent_widget_post_date">7 березня 2016</span>
                    </div>
                </div>
                <a href="#" class="enigma_blog_read_btn"><i class="fa fa-plus-circle"></i>Дізнатись більше</a>
            </div>
            <!-- side widget-->
            <!-- weather widget -->

            <!-- weather widget -->
        </div>
    </div> <!-- row -->

<!-- /enigma Callout Section -->