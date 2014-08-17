<?php
/**
 * Created by PhpStorm.
 * User: borsosalbert
 * Date: 2014.08.17.
 * Time: 11:55
 */

namespace albertborsos\yii2lib\helpers;

use yii\data\ArrayDataProvider;
use yii\helpers\BaseFileHelper;

class File extends BaseFileHelper {

    public static function dirContentToDataProvider($path, $options){
        $source = [];
        $dirContent = self::findFiles($path, $options);

        foreach($dirContent as $id => $filePath){
            $exploded = explode('/', $filePath);
            $fileName = $exploded[count($exploded)-1];

            $source[] = [
                'id' => $id,
                'fileName' => $fileName,
                'filePath' => $filePath,
            ];

        }

        return new ArrayDataProvider([
            'allModels' => $source,
            'key' => 'fileName',
        ]);
    }
} 