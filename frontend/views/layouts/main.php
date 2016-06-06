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
use common\widgets\LeftMenu;
use kartik\social\FacebookPlugin;
use yii\helpers\Url;
use common\widgets\PageOutput;

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
                        <a href="<?=Url::home()?>" title="AlpeAdria Tour" rel="home">
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
                        <a href="https://facebook.com/Альпи-Адріа-Тур-1490290177946348" target="_blank"><li data-original-title="Facebook" class="facebook" data-toggle="tooltip" data-placement="top" title=""><i class="fa fa-facebook"></i></li></a>
                        <a href="http://vk.com/alpeadriatour" target="_blank"><li data-original-title="Vk" class="vk" data-toggle="tooltip" data-placement="top" title=""><i class="fa fa-vk"></i></li></a>
                        <a href="/site/contact#w1-tab1"><li data-original-title="напишіть нам" class="dribbble" data-toggle="tooltip" data-placement="top" title="Напишіть нам"><i class="fa fa-envelope"></i></li></a>
                        <!--<a href="http://linkedin.com/"><li data-original-title="Linkedin" class="linkedin" data-toggle="tooltip" data-placement="top" title=""><i class="fa fa-linkedin"></i></li></a>
                        <a href="https://www.youtube.com/"><li data-original-title="Youtube" class="youtube" data-toggle="tooltip" data-placement="top" title=""><i class="fa fa-youtube"></i></li></a>-->
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

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => 'Домашня', 'url' => ['/site/index']],
            ['label' => 'Підбір туру', 'url' => ['/site/tour-select'],
                'items' => [
                    ['label' => 'Екскурсії', 'url' => ['/site/excursions'] ],
                    ['label' => 'Всі країни', 'url' => ['/site/all-countries']],
                    ['label' => 'Круїзи', 'url' => ['/site/cruises']],
                    ['label' => 'Активний відпочинок', 'url' => ['/site/vacations']],
                ],
            ],
            ['label' => 'Раннє бронювання', 'url' => ['/site/booking']],
            ['label' => 'Інформація подорожуючому', 'url' => ['/site/travel-info']],
            ['label' => 'Про нас', 'url' => ['/site/about']],
            ['label' => 'Контакти', 'url' => ['/site/contact']],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container-full">
        <div class="row">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-8">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                 ]) ?>
                <?= Alert::widget() ?>
            </div>
            <div class="col-sm-2">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">
                <div class="alpe_heading_title">
                    <h4>Тури по країнах</h4>
                </div>
                <nav>
                    <?=LeftMenu::widget();?>
                </nav>
            </div>
        <?= $content ?>

        </div> <!-- row -->
    </div> <!-- container ->
</div>

<!-- Footer Widget Secton -->
    <div class="alpe_footer_widget_area">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 alpe_footer_widget_column">
                    <?=PageOutput::widget([
                        'page_name' => 'benefit',
                        'header_class' => 'alpe_footer_widget_title',
                        'body_class' => 'content-line'
                    ])?>
                </div>
                <div class="col-md-3 col-sm-6 alpe_footer_widget_column">
                    <h3 class="alpe_footer_widget_title">Останнє додане<div class="alpe-footer-separator" id=""></div></h3>
                    <?php foreach( \common\models\helper::recentProducts() as $recent) { ?>
                    <div class="media alpe_recent_widget_post">
                        <a class="alpe_recent_widget_post_move" href="#">
                            <img src="/images/<?=$recent->id?>/<?=$recent->main_image?>" class="alpe_recent_widget_post_img">
                        </a>
                        <div class="media-body">
                            <h3><a href="#"><?=$recent->name?></a></h3>
                            <span class="alpe_recent_widget_post_date"><?=Yii::$app->formatter->asDate($recent->created_at)?></span>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="col-md-3 col-sm-6 alpe_footer_widget_column">
                    <h3 class="alpe_footer_widget_title">Ми у Facebook<div class="alpe-footer-separator" id=""></div></h3>
                    <?=FacebookPlugin::widget(['type'=>FacebookPlugin::PAGE, 'settings' => ['href'=>'http://facebook.com/Альпи-Адріа-Тур-1490290177946348']]);?>
                </div>

                <div class="col-md-3 col-sm-6 alpe_footer_widget_column">
                    <h3 class="alpe_footer_widget_title">Контакти<div class="alpe-footer-separator" id=""></div></h3>
                    <address>
                        <p><i class="fa fa-phone"></i> +38 (032) 232-29-01</p>
                        <p><i class="fa fa-envelope"></i><a href="mailto:office@alpeadriatour.com">office@alpeadriatour.com</a></p>
                        <p><i class="fa fa-globe"></i>79017 Львів</p>
                        <p><i class="fa fa-globe"></i>вул.Водогінна 2/322</p>
                        <p><i class="fa fa-clock-o"></i> Пн-Пт 10:00 - 18:00</p>
                        <p><i class="fa fa-map-marker"></i> <a href="mailto:office@alpeadriatour.com">office@alpeadriatour.com</a></p>
                        <p style="display: none"><i class="fa fa-newspaper-o"></i>
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
    <div class="alpe_footer_area">
        <div class="container">
            <div class="col-md-12">
                <p class="alpe_footer_copyright_info wl_rtl">туристична фірма Альпи Адріа-Тур <?=date('Y', time())?>&nbsp;<a rel="nofollow" href="#</a>
			</p>
						<div class="alpe_footer_social_div">
                <ul class="social">
                    <a href="https://facebook.com/Альпи-Адріа-Тур-1490290177946348" target="_blank"><li data-original-title="Facebook" class="facebook" data-toggle="tooltip" data-placement="top" title=""><i class="fa fa-facebook"></i></li></a>
                    <a href="http://vk.com/alpeadriatour" target="_blank"><li data-original-title="Vk" class="vk" data-toggle="tooltip" data-placement="top" title=""><i class="fa fa-vk"></i></li></a>
                    <a href="/site/contact#w1-tab1"><li data-original-title="напишіть нам" class="dribbble" data-toggle="tooltip" data-placement="top" title="Напишіть нам"><i class="fa fa-envelope"></i></li></a>
                    <!-- <a href="https://twitter.com/"><li data-original-title="Twiiter" class="twitter" data-toggle="tooltip" data-placement="top" title=""><i class="fa fa-twitter"></i></li></a>
                     <a href="https://dribbble.com/"><li data-original-title="Dribble" class="dribbble" data-toggle="tooltip" data-placement="top" title=""><i class="fa fa-dribbble"></i></li></a>
                     <a href="http://linkedin.com/"><li data-original-title="Linkedin" class="linkedin" data-toggle="tooltip" data-placement="top" title=""><i class="fa fa-linkedin"></i></li></a>
                     <a href="https://www.youtube.com/"><li data-original-title="Youtube" class="youtube" data-toggle="tooltip" data-placement="top" title=""><i class="fa fa-youtube"></i></li></a>

                     <a href="https://plus.google.com/"><li data-original-title="Googleplus" class="Googleplus" data-toggle="tooltip" data-placement="top" title=""><i class="fa fa-google"></i></li></a>
                     <a href="https://www.flickr.com/"><li data-original-title="Flicker" class="flicker" data-toggle="tooltip" data-placement="top" title=""><i class="fa fa-flickr"></i></li></a>

                     <a href="https://instagram.com/"><li data-original-title="Instagram" class="instagram" data-toggle="tooltip" data-placement="top" title=""><i class="fa fa-instagram"></i></li></a>-->
                </ul>
            </div>
        </div>
    </div>
</div>

<!--Scroll To Top-->
<a style="display: inline;" href="#" title="Go Top" class="alpe_scrollup"><i class="fa fa-chevron-up"></i></a>
<!--/Scroll To Top-->


<!-- /Footer Widget Secton -->
<!--Scroll To Top-->
<a style="display: inline;" href="#" title="Go Top" class="alpe_scrollup"><i class="fa fa-chevron-up"></i></a>
<!--/Scroll To Top-->
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
