<?php
/**
 * Created by PhpStorm.
 * User: borsosalbert
 * Date: 2014.07.01.
 * Time: 15:51
 */

namespace albertborsos\yii2lib\wrappers;


use dosamigos\editable\Editable as XEditable;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class Editable {
    public static function select($name, $pk, $defaultValue, $defaultText, $url, $sourceArray, $pluginOptions = []){
        return XEditable::widget(ArrayHelper::merge([
            'name' => $name,
            'value' => $defaultText,
            'url' => $url,
            'type' => 'select',
            'mode' => 'pop',
            'clientOptions' => [
                'pk' => $pk,
                'defaultValue' => $defaultValue,
                'placement' => 'top',
                'source' => self::compileSourceArray($sourceArray)
            ]
        ], $pluginOptions));
    }
    public static function select2($name, $pk, $defaultValue, $defaultText, $url, $sourceArray, $pluginOptions = []){
        return XEditable::widget(ArrayHelper::merge([
            'name' => $name,
            'value' => $defaultText,
            'url' => $url,
            'type' => 'select2',
            'mode' => 'pop',
            'clientOptions' => [
                'pk' => $pk,
                'defaultValue' => $defaultValue,
                'placement' => 'top',
                'select2' => [
                    'width' => '230px'
                ],
                'source' => self::compileSourceArray($sourceArray)
            ]
        ], $pluginOptions));
    }

    public static function compileSourceArray($sourceArray){
        $result = [];

        foreach($sourceArray as $key => $value){
            $result[] = [
                'id' => $key, //select2
                'value' => $key, // normal select
                'text' => $value,
            ];
        }

        return $result;
    }
} 