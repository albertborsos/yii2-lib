<?php
/**
 * Created by PhpStorm.
 * User: borsosalbert
 * Date: 2014.07.29.
 * Time: 14:56
 */

namespace albertborsos\yii2lib\helpers;


use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;

class S
{
    /**
     * var_dump() wrapper with autoexit
     *
     * @param $var
     * @param bool $isExit
     * @param bool $asString
     * @param int $depth
     * @return string
     */
    public static function dump($var, $isExit = true, $asString = false, $depth = 3)
    {
        if ($asString) {
            return VarDumper::dumpAsString($var, $depth, true);
        } else {
            VarDumper::dump($var, $depth, true);
        }
        if ($isExit) exit;
    }

    /**
     * recursively returns the arrays value by key fields separated with '.'
     * @param array $array
     * @param string $path - string, array keys separated with '.'
     * @param mixed|null $defaultValue
     * @return mixed|null
     * @deprecated use \yii\helpers\ArrayHelper::getValue() instead
     */
    public static function get($array, $path, $defaultValue = null)
    {
        return ArrayHelper::getValue($array, $path, $defaultValue);
    }

    public static function powered()
    {
        return 'Powered by <a href="http://www.yiiframework.com/" rel="external" target="_blank">Yii Framework</a>';
    }

    public static function divider($visible = true)
    {
        $hidden = $visible ? '' : ' hidden';
        return '<li class="divider' . $hidden . '"></li>';
    }
} 