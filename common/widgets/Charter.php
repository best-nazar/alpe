<?php
/**
 * Avto-Charters widget
 */
namespace common\widgets;

use common\models\Product;
use yii\helpers\Url;

class Charter extends \yii\bootstrap\Widget
{
    private $model; //Product
    public $type;  // helper::PRODUCT_TYPE_AVTO / AVIA
    public $header;

    public function init()
    {
        parent::init();

        $this->model = Product::find()
            ->joinWith('options0')
            ->andWhere(['>=','actual_date',time()]) // show before actual_date
            ->andWhere(['options.show_in_dash'=>1,'type'=> $this->type])
            ->orderBy('id')
            ->all();

        $this->printBlock();
    }

    private function printBlock(){
        if ($this->model) {
            echo '<div class="enigma_sidebar_widget">';
            echo '<div class="enigma_sidebar_widget_title"><h2>'.$this->header.'</h2></div>';
            foreach ($this->model as $obj) {
                echo '<div class="media enigma_recent_widget_post">';
                //echo '<a title="Переглянути" href="' . Url::to(['site/show-product', 'id' => $obj->id]) . '" class="enigma_recent_widget_post_move">';
                //echo '<img width="64" height="64" alt="portfolio-5" class="enigma_recent_widget_post_img wp-post-image"';
                //echo 'src="/images/' . $obj->id . '/' . $obj->main_image . '">';
                //echo '</a>';
                echo '<div class="media-body">';
                echo '<h4><a href="'. Url::to(['site/show-product', 'id' => $obj->id]) .'">'.$obj->name.'</a></h4>';
                //echo '<span class="enigma_recent_widget_post_date">'.$obj->created_at.'</span>';
                echo '</div>';
                echo '</div>';
            }
            echo '<a href="' . Url::to(['site/charters', 'type' => $this->type]) . '" class="enigma_blog_read_btn"><i class="fa fa-plus-circle"></i>Більше...</a>';
            echo '</div>';
        }
    }
}