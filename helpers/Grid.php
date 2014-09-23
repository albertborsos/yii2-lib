<?php
/**
 * Created by PhpStorm.
 * User: borsosalbert
 * Date: 2014.09.23.
 * Time: 10:57
 */

namespace albertborsos\yii2lib\helpers;


use albertborsos\yii2lib\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use Yii;

class Grid {
    public static function dropDownFilterDynamic($modelClassName, $attributeName, $options = [], $filterByUser = false){
        if (empty($options)){
            $query = $modelClassName::find()
                 ->asArray()
                 ->select($attributeName)
                 ->distinct()
                 ->where($attributeName.' IS NOT NULL')
                 ->orderBy($attributeName.' ASC');
            if ($filterByUser){
                $query->andWhere('created_user='.Yii::$app->getUser()->getId())->all();
            }

            return ArrayHelper::map($query->all(), $attributeName, $attributeName);
        }else{
            // ha van options array
            $itemsCategory     = S::get($options, 'itemsCategory');
            $dataProviderClass = S::get($options, 'dataProviderClass');

            if ($itemsCategory !== null && $dataProviderClass !== null){
                $query = $modelClassName::find()
                    ->asArray()
                    ->select($attributeName)
                    ->distinct()
                    ->where($attributeName.' IS NOT NULL')
                    ->orderBy($attributeName.' ASC');

                if ($filterByUser){
                    $query->andWhere('created_user='.Yii::$app->getUser()->getId())->all();
                }
                $listData = [];
                foreach($query->all() as $model){
                    $value = S::get($model, $attributeName);
                    $text  = $dataProviderClass::items($itemsCategory, $value, false);
                    $listData[$value] = $text;
                }

                return $listData;
            }

            $foreignClassName = S::get($options, 'foreignClassName');
            $foreignKey       = S::get($options, 'foreignKey', 'id');
            $foreignName      = S::get($options, 'foreignName', 'name');

            if ($foreignClassName !== null){
                $tblPrefixModel   = $modelClassName::tableName().'.';
                $tblPrefixForeign = $foreignClassName::tableName().'.';
                $query = $modelClassName::find()->asArray()->select($tblPrefixModel.$attributeName.' as id, '.$tblPrefixForeign.$foreignName.' as name')
                    ->distinct()
                    ->leftJoin($foreignClassName::tableName(), $tblPrefixModel.$attributeName.'='.$tblPrefixForeign.$foreignKey)
                    ->where($tblPrefixModel.$attributeName.' IS NOT NULL');
                if ($filterByUser){
                    $query->andWhere($tblPrefixModel.'created_user='.Yii::$app->getUser()->getId());
                }

                return ArrayHelper::map($query->all(), 'id', 'name');
            }
        }
    }
} 