<?php

namespace albertborsos\yii2lib\widgets;

use kartik\base\InputWidget;
use yii\helpers\ArrayHelper;

class Editable extends \kartik\editable\Editable
{
    protected function renderWidget($class)
    {
        if ($this->hasModel()) {
            if (isset($this->_form)) {
                return $this->getField()->widget($class, $this->_inputOptions);
            }
            $defaults = ['model' => $this->model, 'attribute' => $this->attribute];

        } else {
            $defaults = ['name' => $this->name, 'value' => $this->value];
        }
        $options = ArrayHelper::merge($defaults, $this->_inputOptions); // merge order changed to fix default value for multiple values in select2
        /**
         * @var InputWidget $class
         */
        $field = $class::widget($options);
        return $this->getOutput($field);
    }

}