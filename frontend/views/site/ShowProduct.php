<?php
/**
 * Single Product detail view
 */

/* @var $model common\models\Product */

use frontend\assets\HomePageAsset;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\bootstrap\Tabs;
use common\widgets\Stars;
use yii\data\ArrayDataProvider;
use yii\helpers\Url;

$country = \common\models\helper::getCountry($model->country);
$type = $model->type0->name;

$this->title = Yii::$app->params['orgName'].' - '.$type.' - '.$model->name;
$this->params['breadcrumbs'][] = ['label' => $country->name, 'url' => ['site/by-country', 'countryId' => $model->country]];
$this->params['breadcrumbs'][] = $type;

HomePageAsset::register($this);

?>
<?php
$productStartDate = \common\models\helper::productStartDate($model); // applyDated begin_date timestamp
//$productCurrency = $model->currency0->label;
?>
<div class="col-sm-8">

    <div id="post-1" class="alpe_blog_full post-1 post type-post status-publish format-standard has-post-thumbnail hentry category-uncategorized">
        <ul class="blog-date-left">
            <li title="" data-original-title="" class="alpe_post_date"><span class="date"><?=date('d',$productStartDate)?></span><h6><?=Yii::$app->formatter->asDate(date('Y-m-d',$productStartDate),'long')?></h6></li>
            <!--<li title="" data-original-title="" class="alpe_blog_comment"><i class="fa fa-comments-o"></i><h6><a href="#">1</a></h6></li>-->
        </ul>
        <div class="post-content-wrap">
            <div class="alpe_blog_thumb_wrapper_showcase">
                <div class="alpe_blog-img">
                    <img src="/images/<?=$model->id?>/<?=$model->main_image?>"
                         class="alpe_img_responsive wp-post-image" alt="<?=$model->name?>" >
                </div>
            </div>
            <div class="alpe_fuul_blog_detail_padding">
                <h2><a href="<?=\yii\helpers\Url::to(['site/show-product', 'id'=>$model->id])?>">
                        <?=$model->name?>
                    </a>
                    <div class="starsWidget">
                    <?=Stars::widget([
                        'product'=>$model
                    ]);?>
                    </div>
                </h2>

                <p><?=$model->short_desc?></p>

                <?=Tabs::widget([
                    'items' => [
                        [
                            'label' => 'Опис об`єкту',
                            'content' => DetailView::widget([
                                'model' => $model->productoptions[0],
                                'attributes' => \common\models\helper::productOptionsAttributes($model->productoptions[0]),
                            ]),
                            'headerOptions' => \common\models\helper::productOptionsAttributes($model->productoptions[0])==null ? ['style' => 'display:none'] : ['id' => 'opt'],
                            'active' => true,
                        ],
                        [
                            'label' => 'Загальна інформація',
                            'content' => $model->description. DetailView::widget([
                                    'model' => $model,
                                    'attributes' => [
                                        [                      // the owner name of the model
                                            'label' => 'Локація',
                                            'value' => '<b>'.$model->country0->name.'</b> ' .$model->region1.' ' .$model->region2,
                                            'format' =>'html'
                                        ],
                                        [                      // the owner name of the model
                                            'label' => 'Ціна',
                                            'value' => $model->price.' '. $model->currency0->label,
                                        ],
                                    ],
                                ]),

                        ],
                        [
                            'label'=> 'Ціни',
                            'content' => GridView::widget([
                                'dataProvider' => new ArrayDataProvider([
                                    'allModels' => $model->applydates,
                                ]),
                                'columns' => [
                                    'begin_date:date',
                                    'end_date:date',
                                    'place_type',
                                    [
                                        'label' => 'Ціна',
                                        'value' => function ($model, $index, $widget) {
                                            $productCurrency = \common\models\Product::findOne($model->product_id);
                                            return $model->price.' '.$productCurrency->currency0->label;
                                        },
                                    ]
                                ],
                                'layout' => '{items}'
                            ]),
                        ],
                        [
                            'label' => 'Фотогалерея',
                            'content' => $this->render ('_image_gallery',[
                                'model' => $model,
                            ]),
                        ],
                    ],
                ]);?>

                <div class="blog-post-details-item">
                    <a class="alpe_blog_read_btn" href="<?=Url::to(['site/new-order', 'id'=>$model->id])?>"><i class="fa fa-plus-circle"></i>Замовити</a></div>
                </div>
            <div class="pull-left">
                <a class="back_btn" href="<?=Yii::$app->request->referrer?>"><i class="fa fa-backward"></i> Повернутись </a></div>
            </div>
        </div>
    </div>

<?php
//\common\models\helper::productOptionsAttributes($model->productoptions[0])?>

</div><!-- col -->
<div class="col-sm-2">
</div>