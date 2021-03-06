<?php
/**
 * Page content widget
 */

namespace common\widgets;

use common\models\Page;

class PageOutput extends \yii\bootstrap\Widget
{
    public $page_name;
    public $header_class;
    public $body_class;
    public $countryCode;

    public function init()
    {
        parent::init();

        if ($this->countryCode){
            $pageToFind = $this->page_name.'-'.strtolower($this->countryCode);
        } else {
            $pageToFind = $this->page_name;
        }

        $page = Page::findOne([ 'page_name'=> $pageToFind ]);
        if ($page) {
            echo '<h3 class="' . $this->header_class . '">';
            echo $page->title;
            echo '<div class="alpe-footer-separator" id=""></div>';
            echo "</h3>";
            echo '<h6 class="' . $this->body_class . '">';
            echo $page->content;
            echo "</h6>";
        }
    }

} 