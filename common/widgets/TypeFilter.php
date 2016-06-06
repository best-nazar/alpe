<?php
/**
 * Filter product vy Type
 * User: Naz
 * Date: 06.06.2016
 * Time: 8:47
 */

namespace common\widgets;

use yii\helpers\Html;
use common\models\helper;

class TypeFilter extends \yii\bootstrap\Widget  {
    public $model;
    public $mainUrl;
    public $field;  //ex. region1

    public function init()
    {
        parent::init();

        if ($this->filterArray()){
            $this->printDropDown();
        }
    }

    private function filterArray(){
        $arr =[];
        foreach ($this->model as $data) {
            if ($data[$this->field]) // not NULL
            if ( !array_key_exists ($data[$this->field],$arr ) ) {
                $arr[$data[$this->field]] = [
                    'label' => helper::getSybTypeName($data[$this->field]),
                    'url' => $this->mainUrl . '?' . $this->field . '=' . $data[$this->field],
                    'class' => $data[$this->field] == \Yii::$app->request->getQueryParam($this->field) ? 'list-group-item active' : 'list-group-item',
                ];
            }
           /** $arr[] = [
                'label' => helper::getSybTypeName(helper::TYPE_APARTMENT),
                'url' => $this->mainUrl . '?' . $this->field . '=' . helper::TYPE_APARTMENT,
                'class' => helper::TYPE_APARTMENT == \Yii::$app->request->getQueryParam($this->field) ? 'list-group-item active' : 'list-group-item',
            ];*/
        }
        return $arr;
    }

    private function printDropDown(){
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