<?php
/**
 * Product filtered by Booking
 */

/* @var $data common\models\Product */

use yii\helpers\Url;
use frontend\assets\HomePageAsset;

HomePageAsset::register($this);
$this->title = Yii::$app->params['orgName'].' - Раннє бронювання';
$this->params['breadcrumbs'][] = 'Раннє бронювання';
?>
<div class="col-sm-8">

    <div style="display: block; text-align: start; float: none; position: relative; top: auto; right: auto; bottom: auto; left: auto; z-index: auto; width: auto; height: auto; margin: 0px; overflow: hidden;" class="caroufredsel_wrapper">
        <?php foreach ($data as $obj) {?>
            <div class="col-md-4 col-sm-12 scrollimation scale-in d2 pull-left" style="width: 100%">
                <div class="alpe_blog_thumb_wrapper">
                    <div class="alpe_blog_thumb_wrapper_showcase">
                        <img src="/images/<?=$obj->id?>/<?=$obj->main_image?>" class="alpe_img_responsive wp-post-image" alt="<?=$obj->name?>">
                        <div class="alpe_blog_thumb_wrapper_showcase_overlay">
                            <div class="alpe_blog_thumb_wrapper_showcase_overlay_inner ">
                                <div class="alpe_blog_thumb_wrapper_showcase_icons">
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
                    <div class="alpe_blog_thumb_footer">
                        <ul class="alpe_blog_thumb_date">
                            <li title="Переглянути" data-original-title=""><i class="fa fa-money"></i>
                                <a href="<?=Url::to(['site/show-product','id'=>$obj->id])?>"><?=$obj->price?>&nbsp;<?=$obj->currency0->code?></a>
                            </li>
                            <li title="" data-original-title=""><i class="fa fa-clock-o"></i>
                                <?=Yii::$app->formatter->asDate($obj->created_at)?>
                            </li>
                        </ul>
                    </div>
                    <a href="<?=Url::to(['site/show-product','id'=>$obj->id])?>" class="alpe_blog_read_btn"><i class="fa fa-plus-circle"></i>Дізнатись більше</a>
                </div>
            </div>
        <?php } ?>

        <?php if (!$data) { ?>
            <div class="alpe_blog_thumb_wrapper">
                <h2>Відсутні записи</h2>
                <a href="<?=Yii::$app->request->referrer?>">повторити спробу...</a>
            </div>
        <?php } ?>
    </div>

</div>
<div class="col-sm-2">
    <?= $this->render('_side_widgets')?>
</div>