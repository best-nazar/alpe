<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use common\widgets\Stars;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="csstransforms csstransforms3d csstransitions" lang="<?= Yii::$app->language ?>"><!--<![endif]-->
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="home blog wide">
<?php $this->beginBody() ?>

<div id="wrapper">
    <div class="header_section">
        <div class="container">
            <!-- Logo & Contact Info -->
            <div class="row ">
                <div class="col-md-6 col-sm-12 wl_rtl">
                    <div class="logo">
                        <a href="#" title="AlpeAdria Tour" rel="home">
                            AlpeAdria Tour						</a>
                        <p>Travel with us!</p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <ul class="head-contact-info">
                        <li title="" data-original-title=""><i class="fa fa-envelope"></i><a href="mailto:office@alpeadriatour.com">вул.Водогінна 2/322, Львів</a></li>
                        <li title="" data-original-title=""><i class="fa fa-phone"></i><a href="tel:+380322322901">+38 (032) 232-29-01</a></li>
                    </ul>
                    <ul class="social">
                        <a href="https://facebook.com/"><li data-original-title="Facebook" class="facebook" data-toggle="tooltip" data-placement="top" title=""><i class="fa fa-facebook"></i></li></a>
                        <a href="http://linkedin.com/"><li data-original-title="Linkedin" class="linkedin" data-toggle="tooltip" data-placement="top" title=""><i class="fa fa-linkedin"></i></li></a>
                        <a href="https://www.youtube.com/"><li data-original-title="Youtube" class="youtube" data-toggle="tooltip" data-placement="top" title=""><i class="fa fa-youtube"></i></li></a>
                    </ul>
                </div>
            </div>
            <!-- /Logo & Contact Info -->
        </div>
    </div>

    <?php
    NavBar::begin([
        //'brandLabel' => 'My Company',
        //'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'nav navbar-default navigation_menu affix',
        ],
    ]);
    $menuItems = [
        ['label' => 'Домашня', 'url' => ['/site/index']],
        ['label' => 'Підбір туру', 'url' => ['/site/about'],
            'items' => [
                ['label' => 'Екскурсії', 'url' => ['/site/index'], 'options'=>['class'=>'menu-item menu-item-type-post_type menu-item-object-page menu-item-30'] ],
                ['label' => 'Всі країни', 'url' => ['/site/index']],
                ['label' => 'Круїзи', 'url' => ['/site/index']],
                ['label' => 'Активний відпочинок', 'url' => ['/site/index']],
            ],
        ],
        ['label' => 'Раннє бронювання', 'url' => ['/site/contact']],
        ['label' => 'Інформація подорожуючому', 'url' => ['/site/contact']],
        ['label' => 'Про нас', 'url' => ['/site/contact']],
        ['label' => 'Контакти', 'url' => ['/site/contact']],
    ];

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container-full">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
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
        <?= $content ?>

        </div> <!-- row -->
    </div> <!-- container ->
</div>

<!-- Footer Widget Secton -->
    <div class="enigma_footer_widget_area">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 enigma_footer_widget_column">
                    <h3 class="enigma_footer_widget_title">Чому ми: <div class="enigma-footer-separator" id=""></div></h3>
                    <h6>Lorem ipsum dolor sit amet, no consequat ullamcorper nec, te commune constituto intellegebat eam.
                        Soleat populo id nec. Est in altera vocibus, et vim iudico adolescens, mel no discere mediocritatem.
                        Nec ei sale honestatis, graeco melius eruditi qui et, id nam mucius maiorum. Pri diceret ornatus cu,
                        dico quas aliquando vix ea, vix impetus invidunt honestatis id. An his everti animal.				</h6>
                </div>
                <div class="col-md-3 col-sm-6 enigma_footer_widget_column">
                    <h3 class="enigma_footer_widget_title">Останнє додане<div class="enigma-footer-separator" id=""></div></h3>
                    <?php foreach( \common\models\helper::recentProducts() as $recent) { ?>
                    <div class="media enigma_recent_widget_post">
                        <a class="enigma_recent_widget_post_move" href="#">
                            <img src="/images/<?=$recent->id?>/<?=$recent->main_image?>" class="enigma_recent_widget_post_img">
                        </a>
                        <div class="media-body">
                            <h3><a href="#"><?=$recent->name?></a></h3>
                            <span class="enigma_recent_widget_post_date"><?=Yii::$app->formatter->asDate($recent->created_at)?></span>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="col-md-3 col-sm-6 enigma_footer_widget_column">
                    <h3 class="enigma_footer_widget_title">Ми у Facebook<div class="enigma-footer-separator" id=""></div></h3>
                    <ul class="flickr-photos-list">
                        <li title="" data-original-title=""><a href="http://farm8.staticflickr.com/7373/10412001266_483a1e4c9d_b.jpg"><img src="Weblizar_files/10412001266_483a1e4c9d_s.jpg" alt="Jackie Martinez (#9963)"></a></li>
                        <li title="" data-original-title=""><a href="http://farm4.staticflickr.com/3705/10278343103_dd92d24d07_b.jpg"><img src="Weblizar_files/10278343103_dd92d24d07_s.jpg" alt="Tim Atlas - Lost in the Waiting Album Cover"></a></li>
                        <li title="" data-original-title=""><a href="http://farm9.staticflickr.com/8552/10217169844_a83bb0c26f_b.jpg"><img src="Weblizar_files/10217169844_a83bb0c26f_s.jpg" alt="Ortofon Concorde S-120 (#1211)"></a></li>
                        <li title="" data-original-title=""><a href="http://farm4.staticflickr.com/3832/9391366956_eae44dee74_b.jpg"><img src="Weblizar_files/9391366956_eae44dee74_s.jpg" alt="Horse #9119"></a></li>
                        <li title="" data-original-title=""><a href="http://farm6.staticflickr.com/5529/9163716976_d5d1a0c052_b.jpg"><img src="Weblizar_files/9163716976_d5d1a0c052_s.jpg" alt="5 241"></a></li>
                        <li title="" data-original-title=""><a href="http://farm9.staticflickr.com/8266/8681566188_62b2ffa05e_b.jpg"><img src="Weblizar_files/8681566188_62b2ffa05e_s.jpg" alt="Content Magazine x weblizar Salon Image Challenge 13 (#6456)"></a></li>
                        <li title="" data-original-title=""><a href="http://farm9.staticflickr.com/8361/8436780884_2b2e984a1b_b.jpg"><img src="Weblizar_files/8436780884_2b2e984a1b_s.jpg" alt="Nasty Ray (#1058)"></a></li>
                        <li title="" data-original-title=""><a href="http://farm9.staticflickr.com/8472/8122661150_5f0dbf6c61_b.jpg"><img src="Weblizar_files/8122661150_5f0dbf6c61_s.jpg" alt="Andrea Garcia / Fancy Made"></a></li>
                        <li title="" data-original-title=""><a href="http://farm9.staticflickr.com/8196/8075637825_4febf52b7a_b.jpg"><img src="Weblizar_files/8075637825_4febf52b7a_s.jpg" alt="Andrea Garcia / Fancy Made (#4427)"></a></li>
                    </ul>
                </div>

                <div class="col-md-3 col-sm-6 enigma_footer_widget_column">
                    <h3 class="enigma_footer_widget_title">Контакти<div class="enigma-footer-separator" id=""></div></h3>
                    <address>
                        <p><i class="fa fa-phone"></i> +38 (032) 232-29-01</p>
                        <p><i class="fa fa-envelope"></i>79017 Львів</p>
                        <p><i class="fa fa-globe"></i>вул.Водогінна 2/322</p>
                        <p><i class="fa fa-clock-o"></i> Пн-Пт 10:00 - 18:00</p>
                        <p><i class="fa fa-map-marker"></i> <a href="mailto:office@alpeadriatour.com">office@alpeadriatour.com</a></p>
                        <p><i class="fa fa-newspaper-o"></i>
                            <?php if (Yii::$app->user->isGuest) {
                                echo Html::a('Реєстрація',['/site/signup']);
                            } else {
                                echo Html::beginForm(['/site/logout'], 'post');
                                echo Html::submitButton(
                                    'Вийти (' . Yii::$app->user->identity->username . ')',
                                    ['class' => 'btn btn-link']
                                );
                                echo Html::endForm();
                            } ?>
                        </p>
                    </address>
                </div>
            </div>
        </div>
    </div>
    <div class="enigma_footer_area">
        <div class="container">
            <div class="col-md-12">
                <p class="enigma_footer_copyright_info wl_rtl">туристична фірма Альпе Адріа Тур 2016&nbsp;<a rel="nofollow" href="#</a>
			</p>
						<div class="enigma_footer_social_div">
                <ul class="social">
                    <a href="https://facebook.com/"><li data-original-title="Facebook" class="facebook" data-toggle="tooltip" data-placement="top" title=""><i class="fa fa-facebook"></i></li></a>
                    <a href="https://twitter.com/"><li data-original-title="Twiiter" class="twitter" data-toggle="tooltip" data-placement="top" title=""><i class="fa fa-twitter"></i></li></a>
                    <a href="https://dribbble.com/"><li data-original-title="Dribble" class="dribbble" data-toggle="tooltip" data-placement="top" title=""><i class="fa fa-dribbble"></i></li></a>
                    <a href="http://linkedin.com/"><li data-original-title="Linkedin" class="linkedin" data-toggle="tooltip" data-placement="top" title=""><i class="fa fa-linkedin"></i></li></a>
                    <a href="https://www.youtube.com/"><li data-original-title="Youtube" class="youtube" data-toggle="tooltip" data-placement="top" title=""><i class="fa fa-youtube"></i></li></a>

                    <a href="https://plus.google.com/"><li data-original-title="Googleplus" class="Googleplus" data-toggle="tooltip" data-placement="top" title=""><i class="fa fa-google"></i></li></a>
                    <a href="https://www.flickr.com/"><li data-original-title="Flicker" class="flicker" data-toggle="tooltip" data-placement="top" title=""><i class="fa fa-flickr"></i></li></a>

                    <a href="https://instagram.com/"><li data-original-title="Instagram" class="instagram" data-toggle="tooltip" data-placement="top" title=""><i class="fa fa-instagram"></i></li></a>
                </ul>
            </div>
        </div>
    </div>
</div>

<!--Scroll To Top-->
<a style="display: inline;" href="#" title="Go Top" class="enigma_scrollup"><i class="fa fa-chevron-up"></i></a>
<!--/Scroll To Top-->


<!-- /Footer Widget Secton -->
<!--Scroll To Top-->
<a style="display: inline;" href="#" title="Go Top" class="enigma_scrollup"><i class="fa fa-chevron-up"></i></a>
<!--/Scroll To Top-->
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
