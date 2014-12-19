<?php
/**
 * Created by PhpStorm.
 * User: borsosalbert
 * Date: 2014.04.15.
 * Time: 19:36
 */

namespace albertborsos\yii2lib\helpers;

use Yii;
use yii\bootstrap\Alert;
use yii\helpers\ArrayHelper;
use yii\widgets\Breadcrumbs;


class Widgets {
	public static function showAlerts(){
		foreach (Yii::$app->getSession()->allFlashes as $type => $message){
			switch($type){
				case 'error':
					$type = 'danger';
					break;
			}
			return Alert::widget([
            		'options' => [
						'class' => 'alert-'.$type,
					],
			  		'body' => $message,
				]);
		}
	}

    public static function showBreadcrumbs($breadcrumbs){
        return Breadcrumbs::widget(
            [
                'links' => $breadcrumbs,
            ]
        );
    }

    public static function redactorOptions(){
        $options = [
			'lang' => 'en',
            'minHeight'    => 200,
            'convertUrlLinks' => false,
            'replaceDivs'  => false,
            'buttonSource' => true,
			'removeEmptyTags' => true,
            'buttons' => ['html', 'formatting', 'bold', 'italic', 'deleted',
                'unorderedlist', 'orderedlist', 'outdent', 'indent',
                'image', 'link', 'alignment', 'horizontalrule']
            // additional buttons
            // 'underline', 'alignleft', 'aligncenter', 'alignright', 'justify'
        ];

        return $options;
    }

    public static function select2TagPluginOptions($sourceArray = []){
        $options = [
            'tags'               => $sourceArray,
            'minimumInputLength' => 1,
            'width'              => '100%',
            'tokenSeparators'    => array(',', '\n'),
        ];

        return $options;
    }

    public static function select2PluginOptions($sourceArray = [], $placeholder = null, $options = []){
        $options = [
            'data' => $sourceArray,
            'options' => [
                'width' => '100%',
                'placeholder' => $placeholder,
                'options' => $options,
            ],
        ];

        return $options;
    }
	public static function select2MultiPluginOptions($sourceArray = [], $placeholder = null, $options = []){
        $options = [
            'data' => $sourceArray,
            'options' => [
				'multiple' => true,
                'width' => '100%',
                'placeholder' => $placeholder,
                'options' => $options,
            ],
        ];

        return $options;
    }
}