<?php
/**
 * Left menu
 * country
 */

namespace common\widgets;

use common\models\Country;
use yii\helpers\Url;

class LeftMenu extends \yii\bootstrap\Widget
{

    public function init()
    {
        parent::init();

        $model = Country::find()
            ->orderBy('name')
            ->all();

        $this->printMenu($model);
    }

    private function printMenu($countryModel){
        echo '<ul class="nav nav-pills nav-stacked">';
        foreach ($countryModel as $model){
           echo '<li><a href="'.Url::to(['site/by-country', 'countryId'=>$model->id]).'">'.$model->name.'<span class="flag" style="background:url(/images/flag/'.strtolower($model->code).'.svg)"></span></a></li>';
        }
        echo '</ul>';
    }
}