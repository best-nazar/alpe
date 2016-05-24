<?php
/**
 * Hotel Stars Widget
 * if stars = 0 widget not shown
 */

/* @var $product common\models\Product */

namespace common\widgets;

class Stars extends \yii\bootstrap\Widget {

    public $product;

    public function init()
    {
        parent::init();
        if ($this->product->productoptions[0]->stars!=0) {
            echo $this->product->productoptions[0]->stars;
            echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
        }
    }
}