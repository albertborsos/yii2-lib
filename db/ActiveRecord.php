<?php
/**
 * Created by PhpStorm.
 * User: borsosalbert
 * Date: 2014.08.06.
 * Time: 14:13
 */

namespace albertborsos\yii2lib\db;

use albertborsos\yii2lib\helpers\Date;
use albertborsos\yii2lib\helpers\S;
use albertborsos\yii2cms\models\Users;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use Yii;

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
        $user = Users::findIdentity($model->updated_user);/** @var $user \albertborsos\yii2cms\models\Users */
        if(!is_null($user)){
            if (!is_null($model->updated_at) && !is_null($model->updated_user)){
                $result = $user->getFullname();
                $result .= '<br />'.Date::timestampToDate($model->updated_at);
            }elseif(!is_null($model->created_at) && !is_null($model->created_user)){
                $result = $user->getFullname();
                $result .= '<br />'.Date::timestampToDate($model->created_at);
            }
            else{
                $result = 'N/A';
            }
        }else{
            $result = 'N/A';
        }

        return $result;
    }

    public static function asDropDown($id, $name, $condition){
        $models = self::findAll($condition);
        return ArrayHelper::map($models, $id, $name);
    }

    protected function setOwnerAndTime(){
        if ($this->isNewRecord){
            $this->created_at = time();
            $this->created_user = Yii::$app->getUser()->getId();
        }else{
            $this->updated_at = time();
            $this->updated_user = Yii::$app->getUser()->getId();
        }
    }

    protected function getNextID(){
        $sql = 'select auto_increment
                from information_schema.TABLES
                where TABLE_NAME=:table_name
                and TABLE_SCHEMA=:schema_name';

        $tableName   = $this->tableName();
        $explodedDSN = explode('dbname=', Yii::$app->db->schema->db->dsn);
        $schemaName  = S::get($explodedDSN, '1');

        $cmd = Yii::$app->db->createCommand($sql);
        $cmd->bindValue(':table_name', $tableName);
        $cmd->bindValue(':schema_name', $schemaName);

        return $cmd->queryScalar();
    }
} 