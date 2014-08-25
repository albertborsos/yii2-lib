<?php
/**
 * Created by PhpStorm.
 * User: borsosalbert
 * Date: 2014.08.25.
 * Time: 12:34
 */

namespace albertborsos\yii2lib\bootstrap;


use yii\base\InvalidConfigException;
use yii\bootstrap\Widget;
use yii\helpers\Html;

class Carousel extends \yii\bootstrap\Carousel{
    public $controls = ['<span class="glyphicon glyphicon-chevron-left"></span>', '<span class="glyphicon glyphicon-chevron-right"></span>'];
    public function init()
    {
        parent::init();
        Html::addCssClass($this->options, 'slide');
    }

    /**
     * Renders previous and next control buttons.
     * @throws InvalidConfigException if [[controls]] is invalid.
     */
    public function renderControls()
    {
        if (isset($this->controls[0], $this->controls[1])) {
            return Html::a($this->controls[0], '#' . $this->options['id'], [
                'class' => 'left carousel-control',
                'data-slide' => 'prev',
            ]) . "\n"
            . Html::a($this->controls[1], '#' . $this->options['id'], [
                'class' => 'right carousel-control',
                'data-slide' => 'next',
            ]);
        } elseif ($this->controls === false) {
            return '';
        } else {
            throw new InvalidConfigException('The "controls" property must be either false or an array of two elements.');
        }
    }

} 