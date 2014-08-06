<?php
/**
 * Created by PhpStorm.
 * User: borsosalbert
 * Date: 2014.08.06.
 * Time: 14:13
 */

namespace albertborsos\yii2lib\db;

use albertborsos\yii2lib\helpers\Date;
use albertborsos\yii2user\models\Users;
use yii\helpers\Html;

class ActiveRecord extends \yii\db\ActiveRecord{

    public function throwNewException($title){
        if (!is_null($this)) $title = '<h4>'.$title.'</h4>';
        $options = [
            'header' => $title,
            'footer' => '',
        ];
        throw new \Exception(Html::errorSummary($this, $options));
    }

    public static function showLastModifiedInfo($model){
        if (!is_null($model->updated_at) && !is_null($model->updated_user)){
            $result = Users::findIdentity($model->updated_user)->getFullname();
            $result .= '<br />'.Date::timestampToDate($model->updated_at);
        }elseif(!is_null($model->created_at) && !is_null($model->created_user)){
            $result = Users::findIdentity($model->created_user)->getFullname();
            $result .= '<br />'.Date::timestampToDate($model->created_at);
        }else{
            $result = 'N/A';
        }

        return $result;
    }
} 