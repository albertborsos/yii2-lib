<?php
/**
 * Created by PhpStorm.
 * User: borsosalbert
 * Date: 2014.08.06.
 * Time: 14:13
 */

namespace albertborsos\yii2lib\db\oci;

use PDO;
use Yii;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class ActiveRecord extends \yii\db\ActiveRecord{

    private $tmp = [];
    private $dateFormat = 'YYYY-MM-DD hh24:mi:ss';

    public function clobs()
    {
        return [];
    }

    public function dates()
    {
        return [];
    }

    public function afterFind()
    {
        parent::afterFind();
        // meg kell nézni, hogy van-e CLOB mező
        foreach($this->clobs() as $attribute){
            if(is_resource($this->$attribute)){
                // ha van, akkor ki kell streamelni a tartalmát
                $sql = 'SELECT '.$attribute.' FROM '.$this->tableName().' WHERE id=:id';
                $this->$attribute = Yii::$app->db->createCommand($sql, [':id' => $this->ID])->queryScalar();
            }
        }
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)){
            foreach($this->clobs() as $attribute){
                $this->tmp[$attribute] = $this->$attribute;
                $this->$attribute      = null;
            }
            foreach($this->dates() as $attribute){
                $this->$attribute = new Expression("to_date('" . $this->$attribute . "','{$this->dateFormat}')");
            }
            return true;
        }else{
            return false;
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        // CLOB update
        if ($this->isNewRecord) {
            $subquery = 'SELECT ID FROM '.$this->tableName().' ORDER BY ID DESC';
            $sql      = 'SELECT * FROM ('.$subquery.') WHERE ROWNUM < 2';
            $pk       = Yii::$app->db->createCommand($sql)->queryScalar();
        }else{
            $pk = $this->getPrimaryKey();
        }

		$n = 1;
		$numTmpItems = count($this->tmp);
		if($numTmpItems > 0){
			$sql = 'UPDATE '.$this->tableName().' SET';
			foreach($this->tmp as $id => $value){
				$sql .= ' '.$id.'=:'.$id;

				if ($n !== $numTmpItems) $sql .= ',';
				$n++;
			}
			$sql .= ' WHERE ID=:pk';

			$cmd = Yii::$app->db->createCommand($sql);
			foreach($this->tmp as $id => $value){
				$cmd->bindParam(':'.$id, $this->tmp[$id], PDO::PARAM_STR, strlen($this->tmp[$id]));
			}
			$cmd->bindParam(':pk', $pk);
			$cmd->execute();
		}

        // restore dates
        foreach($this->dates() as $attribute){
            $this->$attribute = str_replace(array("to_date('", "','{$this->dateFormat}')"), '', $this->$attribute->expression);
        }
    }

    public function throwNewException($title){
        if (!is_null($this)) $title = '<h4>'.$title.'</h4>';
        $options = [
            'header' => $title,
            'footer' => '',
        ];
        throw new \Exception(Html::errorSummary($this, $options));
    }

	public static function asDropDown($id, $name, $condition){
        $models = self::findAll($condition);
        return ArrayHelper::map($models, $id, $name);
    }

    protected function setOwnerAndTime(){
        if ($this->isNewRecord){
            $this->CREATED_AT   = time();
            $this->CREATED_USER = Yii::$app->getUser()->getId();
        }else{
            $this->UPDATED_AT   = time();
            $this->UPDATED_USER = Yii::$app->getUser()->getId();
        }
    }
} 