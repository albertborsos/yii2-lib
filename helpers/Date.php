<?php
/**
 * Created by PhpStorm.
 * User: borsosalbert
 * Date: 2014.08.06.
 * Time: 14:25
 */

namespace albertborsos\yii2lib\helpers;


class Date {
    public static function timestampToDate($timestamp, $formatTo = 'Y-m-d H:i'){
        return date($formatTo, $timestamp);
    }

    public static function reformatDateTime($datetime, $formatFrom = 'Y-m-d H:i:s', $formatTo = 'Y-m-d H:i'){
        return date_format(date_create_from_format($formatFrom, $datetime), $formatTo);
    }
} 