<?php
/**
 * Filter Product by Region
 */

namespace common\widgets;

use yii\helpers\Html;

class Filter extends \yii\bootstrap\Widget {

    public $model;
    public $mainUrl;
    public $field;  //ex. region1

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
            if (!in_array($data[$this->field],$arr)){
                if ($data[$this->field] !='') {
                    $arr[] = [
                        'label' => $data[$this->field],
                        'url' => $this->mainUrl.'?'.$this->field.'='.$data[$this->field],
                        'class' => $data[$this->field] == \Yii::$app->request->getQueryParam($this->field) ? 'list-group-item active' : 'list-group-item',
                    ];
                }
            }
        }
        return $arr;
    }

    private function dropDown(){
        echo '<b>Фільтр :</b>';
        if (\Yii::$app->request->getQueryParam($this->field)) {
            echo Html::a('<span class="label label-info pull-right" title="Відімнити">X</span>', $this->mainUrl);
        }
        echo '<ul class="list-group alpe">';

        foreach($this->filterArray() as $items ){
            echo '<li class="'.$items['class'].'">';
            echo Html::a($items['label'], $items['url']);
            echo '</li>';
        }

        echo '</ul>';
    }
}