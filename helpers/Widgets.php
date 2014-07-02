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
} 