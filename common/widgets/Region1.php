<?php
/**
 * Filter Product by Region1
 */

namespace common\widgets;

use yii\bootstrap\Dropdown;

class Region1 extends \yii\bootstrap\Widget {

    public $model;
    public $mainUrl;

    public function init()
    {
        parent::init();

        if ($this->filterArray()){
            $this->dropDown();
        }
    }

    private function filterArray(){
        $arr =[];
        foreach ($this->model as $data){
            if (!in_array($data->region1,$arr)){
                if ($data->region1 !='') {
                    $arr[] = [
                        'label' => $data->region1,
                        'url' => $this->mainUrl.'?region1='.$data->region1,
                        'submenuOptions' => $data->region1==\Yii::$app->request->getQueryParam('region1') ? 'Selected' : null,
                    ];
                }
            }
        }
        return $arr;
    }

    private function dropDown(){
        echo '<div class="dropdown">';

        echo '<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> вибрати регіон ';
        echo '<span class="caret"></span></button>';

        echo Dropdown::widget([
            'items' => $this->filterArray()
        ]);

        echo '</div>';
    }
}