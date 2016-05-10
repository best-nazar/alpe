<?php
/**
* Helper Class with static functions
 */

namespace common\models;


class helper {

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
} 