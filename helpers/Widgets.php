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
            'minHeight'    => 200,
            'convertLinks' => false,
            'convertDivs'  => false,
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

    public static function select2PluginOptions($sourceArray = []){
        $options = [
            'data' => $sourceArray,
            'options' => [
                'width' => '100%',
            ],
        ];

        return $options;
    }
}