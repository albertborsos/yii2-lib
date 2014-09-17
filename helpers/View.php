<?php
/**
 * Created by PhpStorm.
 * User: borsosalbert
 * Date: 2014.09.17.
 * Time: 11:01
 */

namespace albertborsos\yii2lib\helpers;


class View {
    public static function turnOffAssetBundles(){
        \yii\base\Event::on(\yii\web\View::className(), \yii\web\View::EVENT_AFTER_RENDER, function ($e) {
            $e->sender->assetBundles = [];
        });
    }
} 