<?php
/**
* Helper Class with static functions
 */

namespace common\models;


class helper {
    const SHOW_NUMBER_OF_FOOTER_PRODUCT = 4;

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
} 