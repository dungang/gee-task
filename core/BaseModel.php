<?php
namespace app\core;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use app\behaviors\TimestampBehavior;
use app\behaviors\OperatorBehavior;

class BaseModel extends ActiveRecord
{
    
    private $__has_del = false;
    
    protected $_map_cache_key = false;
    
    public function init(){
        parent::init();
        if($this->hasProperty("is_del")) {
            $this->__has_del = true;
            $this->is_del = 0;
        }
    }
    
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            OperatorBehavior::className(),
        ];
    }
    
    
    
    /**
     * {@inheritDoc}
     * @see \yii\db\ActiveRecord::delete()
     */
    public function delete()
    {
        if($this->__has_del) {
            $this->is_del = 1;
            return $this->update(false);
        }
        return parent::delete();
    }
    
//     /**
//      * {@inheritDoc}
//      * @see \yii\db\ActiveRecord::deleteAll()
//      */
//     public static function deleteAll($condition = null, $params = array())
//     {
//         if(property_exists(self,"is_del")) {
//             return parent::updateAll(['is_del'=>1],$condition,$params);
//         }
//         return parent::deleteAll($condition,$params);
//     }
    
    
    public static function allIdToName($key = 'id', $val = 'name',$where=null,$orderBy=null)
    {
        $models = self::find()->select("$key,$val")->where($where)->orderBy($orderBy)->asArray()->all();
        if (is_array($models)) {
            return ArrayHelper::map($models, $key, $val);
        }
        return $models;
    }
    
    /**
     * 获取去除namespace的类名
     * @return mixed
     */
    public static function getClassShortName(){
        return array_pop(explode("\\",get_called_class()));
    }
}

