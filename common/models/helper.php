<?php
/**
* Helper Class with static functions
 */

namespace common\models;

use yii\helpers\ArrayHelper;

class helper {
    const SHOW_NUMBER_OF_FOOTER_PRODUCT = 3;
    const PRODUCT_PER_PAGE = 10;
    CONST PRODUCT_TYPE_TOUR = 1; // id of types table
    CONST PRODUCT_TYPE_EXCURSIONS = 5; // id of table Types
    CONST PRODUCT_TYPE_CRUISES = 2;
    CONST PRODUCT_TYPE_AVIA = 3;
    CONST PRODUCT_TYPE_AVTO = 4;
    CONST IMAGE_WIDTH = 1000;
    CONST IMAGE_HEIGHT = 400;
    CONST ORDER_STATUS = 1; // Очікує

    CONST TYPE_APARTMENT = 1; // sub_type
    CONST TYPE_HOTEL =2; //Sub_type


    /**
     * @param $count of month to add to Now
     * @return DateTime
     */
    public static function addMonthToNow($count){
        $today =  date('Y-m-d');
        $date = new \DateTime($today);
        $interval = new \DateInterval('P'.$count.'M'); // додати Х місяців
        $date->add($interval);
        return $date;
    }

    /**
     * Add number of Days to Now
     * @param $count
     * @return bool|string
     */
    public static function addDayToNow($count){
        $startDate = time();
        $date = date('Y-m-d', strtotime('+'.$count.' day', $startDate));
        return $date;
    }

    /**
     * Find and return recent added product for Page footer
     * @return array|Product[]
     */
    public static function recentProducts(){
        $recent = Product::find()
            ->where(['>=','actual_date',time()]) // show before actual_date
            ->orderBy(['created_at'=>SORT_DESC, 'updated_at'=>SORT_DESC])
            ->limit( self::SHOW_NUMBER_OF_FOOTER_PRODUCT)
            ->all();
        return $recent;
    }

    /**
     * Find first date element in product ApplyDates model
     * and return begin_date time stamp
     * @param $model
     * @return mixed|null
     */
    public static function productStartDate($model){
        $singleDate =  ArrayHelper::map($model->applydates,'id','begin_date') ;
        $applyDates = array_shift( $singleDate );
        return count($applyDates)>0 ? $applyDates : null;
    }

    /**
     * Show only those Attributes witch has values
     * @param $model
     * @return array
     */
    public static function productOptionsAttributes($model){
        $attributes= [
            'location',
            'stars',
            'in_hotel',
            'in_room',
            'additional_services',
            'food',
            'beach',
            'note',
            'web',
        ];
        $attributesToDisplay =[];
        foreach ($attributes as $value){
            if ( ($model->attributes[$value] != '0') && (!empty($model->attributes[$value])) ) {
                //var_dump($value.' = '.$model->attributes[$value]);
                $attributesToDisplay[] = $value.':html';
            }
        }
        return $attributesToDisplay;
    }

    /**
     * Find country
     * @param $id
     * @return null|static
     */
    public static function getCountry($id){
        return Country::findOne($id);
    }

    /**
     * Find Country by country code
     * @param $code
     * @return null|static
     */
    public static function getCountryByCode($code){
        return Country::findOne([ 'code'=> $code]);
    }

    /**
     * Find Type of Product und return object
     * @param $id
     * @return null|static
     */
    public static function getTypeName($id){
        return Types::findOne($id);
    }

    /**
     * Recursive in_array analog function for multidimensional arrays
     * @param $needle
     * @param $haystack
     * @param bool|false $strict
     * @return bool
     */
    public static function in_array_r($needle, $haystack, $strict = false) {
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && self::in_array_r($needle, $item, $strict))) {
                return true;
            }
        }
        return false;
    }

    /**
     *  Get Sub Type for Product
     * @param $id
     * @return mixed
     */
    public static function getSybTypeName($id){
        $arr = [
            self::TYPE_HOTEL => 'Готель',
            self::TYPE_APARTMENT => 'Апартаменти',
        ];

        return $arr[$id];
    }

    /**
     * Find all country list
     * @return static[]
     */
    public static function getCountryList(){
        return Country::find()
            ->orderBy(['name'=>SORT_ASC])
            ->all();
    }

    /**
     * Multidimensional Array to String
     * @param $array
     * @return string
     */
    public static function convert_multi_array($array) {
        return implode("&",array_map(function($a) {return implode("~",$a);},$array));
    }

    /**
     * Meta tags for page header
     * @return \yii\db\ActiveQuery
     */
    public static function getMetaData()
    {
        $site_controller = \Yii::$app->urlManager->parseRequest(\Yii::$app->request)[0];
        if ('site/show-product' == $site_controller )
        {
            $prodId = \Yii::$app->urlManager->parseRequest(\Yii::$app->request)[1];
            return Teg::findOne(['id'=>$prodId]);
        }
    }
} 