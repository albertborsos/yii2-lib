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

    /**
     * recursively returns the arrays value by key fields separated with '.'

     * @param $array
     * @param $path - string, array keys separated with '.'
     * @param null $defaultValue
     * @return null
     */
    public static function get($array, $path, $defaultValue = null){

        if (isset($array[$path])){
            // returns the element if it has '.' in the key field
            return $array[$path];
        }else{
            $keys = explode('.', $path);
            if (count($keys) > 1){
                //pop-olom az kulcs-ot
                $array_key = array_shift($keys);
                $new_path = implode('.', $keys);
                $value = self::get($array, $array_key);
                // rekurzívan lefut újra
                return self::get($value, $new_path, $defaultValue);
            }else{
                // csak 1 elemű
                if (is_array($array)){
                    return isset($array[$path]) ? $array[$path] : $defaultValue;
                }else{
                    return $defaultValue;
                }
            }
        }
    }
} 