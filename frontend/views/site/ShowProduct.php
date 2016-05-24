<?php
/**
 * Product detail view
 */

/* @var $model frontend\models\Product */

use frontend\assets\HomePageAsset;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\bootstrap\Tabs;
use common\widgets\Stars;
use yii\data\ArrayDataProvider;

$this->title = 'AlpeAdria Tour';
HomePageAsset::register($this);

?>
<?php
$productStartDate = \common\models\helper::productStartDate($model); // applyDated begin_date timestamp

?>
<div class="col-sm-8">

    <div id="post-1" class="enigma_blog_full post-1 post type-post status-publish format-standard has-post-thumbnail hentry category-uncategorized">
        <ul class="blog-date-left">
            <li title="" data-original-title="" class="enigma_post_date"><span class="date"><?=date('d',$productStartDate)?></span><h6><?=Yii::$app->formatter->asDate(date('Y-m-d',$productStartDate),'long')?></h6></li>

            <li title="" data-original-title="" class="enigma_blog_comment"><i class="fa fa-comments-o"></i><h6><a href="http://demo.weblizar.com/enigma-premium/hello-world/#comments">1</a></h6></li>
        </ul>
        <div class="post-content-wrap">
            <div class="enigma_blog_thumb_wrapper_showcase">
                <div class="enigma_blog-img">
                    <img src="/images/<?=$model->id?>/<?=$model->main_image?>"
                         class="enigma_img_responsive wp-post-image" alt="<?=$model->name?>" >
                </div>
                <div class="enigma_blog_thumb_wrapper_showcase_overlay">
                    <div class="enigma_blog_thumb_wrapper_showcase_overlay_inner ">
                        <div class="enigma_blog_thumb_wrapper_showcase_icons">
                            <a title="<?=$model->name?>" href="<?=\yii\helpers\Url::to(['site/show-product', 'id'=>$model->id])?>">
                                <i class="fa fa-link"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="enigma_fuul_blog_detail_padding">

                <h2><a href="<?=\yii\helpers\Url::to(['site/show-product', 'id'=>$model->id])?>">
                        <?=$model->name?>
                    </a>

                    <?=Stars::widget([
                        'product'=>$model
                    ]);?>
                    </h2>

                <p><?=$model->short_desc?></p>

                <?=Tabs::widget([
                    'items' => [
                        [
                            'label' => 'Загальна інформація',
                            'content' => $model->description. DetailView::widget([
                                'model' => $model,
                                'attributes' => [

                                    [                      // the owner name of the model
                                        'label' => 'Країна',
                                        'value' => $model->country0->name,
                                    ],
                                    'region1',
                                    'region2',
                                    [                      // the owner name of the model
                                        'label' => 'Ціна',

                                        'value' => $model->price.' '. $model->currency0->label,
                                    ],
                                ],
                            ]),
                            'active' => true
                        ],
                        [
                            'label' => 'Особливості',
                            'content' => DetailView::widget([
                                'model' => $model->productoptions[0],
                                'attributes' => \common\models\helper::productOptionsAttributes($model->productoptions[0]),
                            ]),
                            'headerOptions' => \common\models\helper::productOptionsAttributes($model->productoptions[0])==null ? ['style' => 'display:none'] : ['id' => 'opt'],
                        ],
                        [
                            'label'=> 'Дати',
                            'content' => GridView::widget([
                                'dataProvider' => new ArrayDataProvider([
                                    'allModels' => $model->applydates,
                                ]),
                                'columns' => [
                                    'begin_date:date',
                                    'end_date:date',
                                ],
                                'layout' => '{items}'
                            ]),
                        ],

                    ],
                ]);?>

                <div class="blog-post-details-item">
                    <a class="enigma_blog_read_btn" href="/"><i class="fa fa-plus-circle"></i>Замовити</a></div>
                </div>
        </div>
    </div>

<?php \common\models\helper::productOptionsAttributes($model->productoptions[0]) ?>

</div><!-- col -->
<div class="col-sm-2">
</div>