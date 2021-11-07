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

class Editable
{
    public static function input($name, $pk, $defaultValue, $url, $pluginOptions = []): string
    {
        return XEditable::widget(ArrayHelper::merge([
            'name' => $name,
            'value' => $defaultValue,
            'url' => $url,
            'type' => 'text',
            'mode' => 'pop',
            'clientOptions' => [
                'pk' => $pk,
                'placement' => 'top',
            ]
        ], $pluginOptions));
    }

    public static function textarea($name, $pk, $defaultValue, $url, $pluginOptions = []): string
    {
        return XEditable::widget(ArrayHelper::merge([
            'name' => $name,
            'value' => $defaultValue,
            'url' => $url,
            'type' => 'textarea',
            'mode' => 'pop',
            'clientOptions' => [
                'pk' => $pk,
                'placement' => 'top',
            ]
        ], $pluginOptions));
    }

    public static function select($name, $pk, $defaultValue, $defaultText, $url, $sourceArray, $pluginOptions = []): string
    {
        return XEditable::widget(ArrayHelper::merge([
            'name' => $name,
            'value' => $defaultText,
            'url' => $url,
            'type' => 'select',
            'mode' => 'pop',
            'clientOptions' => [
                'pk' => $pk,
                'defaultValue' => $defaultValue,
                'placeholder' => $defaultText,
                'placement' => 'top',
                'source' => self::compileSourceArray($sourceArray)
            ]
        ], $pluginOptions));
    }

    public static function select2($name, $pk, $defaultValue, $defaultText, $url, $sourceArray, $pluginOptions = []): string
    {
        return XEditable::widget(ArrayHelper::merge([
            'name' => $name,
            'value' => $defaultValue,
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

    public static function tags($name, $pk, $defaultValue, $defaultText, $url, $sourceArray, $widgetOptions = []): string
    {
        return \kartik\editable\Editable::widget(ArrayHelper::merge([
            'name' => 'value',
            'value' => $defaultValue,
            'inputType' => \kartik\editable\Editable::INPUT_SELECT2,
            'formOptions' => [
                'action' => $url,
            ],
            'options' => [
                'pluginOptions' => [
                    'tags' => array_values($sourceArray),
                    'width' => '300px',
                    'allowClear' => true,
                ],
            ],
        ], $widgetOptions));
    }

    public static function compileSourceArray($sourceArray): array
    {
        $result = [];
        foreach ($sourceArray as $key => $value) {
            if (is_array($value)) {
                return $sourceArray;
            }
            $result[] = [
                'id' => $key, //select2
                'value' => $key, // normal select
                'text' => $value,
            ];
        }
        return $result;
    }
} 