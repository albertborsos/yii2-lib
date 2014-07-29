<?php
/**
 * Created by PhpStorm.
 * User: borsosalbert
 * Date: 2014.07.29.
 * Time: 14:56
 */

namespace albertborsos\yii2lib\helpers;


use yii\helpers\VarDumper;

class S {
    /**
     * var_dump() wrapper with autoexit
     *
     * @param $var
     * @param bool $isExit
     * @param bool $asString
     * @param int $depth
     * @return string
     */
    public static function dump($var, $isExit = true, $asString = false, $depth = 3){
        if ($asString){
            return VarDumper::dumpAsString($var, $depth, true);
        }else{
            VarDumper::dump($var, $depth, true);
        }
        if ($isExit) exit;
    }
} 