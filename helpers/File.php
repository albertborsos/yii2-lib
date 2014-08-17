<?php
/**
 * Created by PhpStorm.
 * User: borsosalbert
 * Date: 2014.08.17.
 * Time: 11:55
 */

namespace albertborsos\yii2lib\helpers;

use Exception;
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

    public static function setContent($path, $content){
        try {
            if (file_exists($path)){
                if (file_put_contents($path, $content)){
                    return true;
                }else{
                    throw new Exception('Nem sikerült írni a fájlba!');
                }
            }else{
                throw new Exception('Nem létezik a fájl!');
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
} 