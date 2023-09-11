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
        return XEditable::widget(
            ArrayHelper::merge([
                'name' => $name,
                'value' => $defaultValue,
                'url' => $url,
                'type' => 'text',
                'mode' => 'pop',
                'clientOptions' => [
                    'pk' => $pk,
                    'placement' => 'top',
                ]
            ], $pluginOptions)
        );
    }

    public static function textarea(string $defaultValue, array $url, array $widgetOptions = []): string
    {
        return \kartik\editable\Editable::widget(
            ArrayHelper::merge([
                'name' => 'value',
                'asPopover' => true,
                'displayValue' => $defaultValue,
                'inputType' => \kartik\editable\Editable::INPUT_TEXTAREA,
                'value' => $defaultValue,
                'submitOnEnter' => false,
                'size' => 'lg',
                'formOptions' => [
                    'action' => $url,
                ],
                'options' => [
                    'class' => 'form-control',
                    'rows' => 5,
                ],
            ], $widgetOptions)
        );
    }

    public static function select($name, $pk, $defaultValue, $defaultText, $url, $sourceArray, $pluginOptions = []): string
    {
        return XEditable::widget(
            ArrayHelper::merge([
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
            ], $pluginOptions)
        );
    }

    public static function select2($name, $pk, $defaultValue, $defaultText, $url, $sourceArray, $pluginOptions = []): string
    {
        return XEditable::widget(
            ArrayHelper::merge([
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
            ], $pluginOptions)
        );
    }

    public static function tags(string $defaultValue, array $url, array $sourceArray, array $widgetOptions = []): string
    {
        $editableId = uniqid('editable_');
        return \albertborsos\yii2lib\widgets\Editable::widget(
            ArrayHelper::merge([
                'name' => 'value',
                'value' => $defaultValue,
                'inputType' => \kartik\editable\Editable::INPUT_SELECT2,
                'formOptions' => [
                    'action' => $url,
                ],
                'options' => [
                    'id' => $editableId,
                    'value' => self::get_keys_from_source_array($defaultValue, $sourceArray),
                    'initValueText' => $defaultValue,
                    'data' => ArrayHelper::isIndexed($sourceArray, true)
                        ? array_combine(array_values($sourceArray), array_values($sourceArray))
                        : $sourceArray,
                    'showToggleAll' => false,
                    'pluginOptions' => [
                        'dropdownParent' => "#{$editableId}-popover",
                        'tags' => false,
                        'multiple' => true,
                        'allowClear' => true,
                        'tokenSeparators' => ',',
                    ],
                ],
            ], $widgetOptions)
        );
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

    /**
     * Returns the keys of the source array based on the default values
     * it is  necessary to preload the selected labels in the input field
     *
     * @param string $defaultValue
     * @param array $sourceArray
     * @return array
     */
    protected static function get_keys_from_source_array(string $defaultValue, array $sourceArray): array
    {
        if (ArrayHelper::isIndexed($sourceArray, true)) {
            return explode(',', $defaultValue);
        }

        $defaultValues = explode(',', $defaultValue);
        $result = [];
        foreach ($defaultValues as $value) {
            $result[] = array_search($value, $sourceArray);
        }
        return $result;
    }
} 