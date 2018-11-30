<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "gt_event".
 *
 * @property int $id
 * @property int $created_at 添加时间
 * @property int $updated_at 更新时间
 * @property string $name 名称
 * @property string $code 编码
 * @property string $intro 介绍
 */
class Event extends \app\core\BaseModel
{
    
    const CacheKey = 'event.handlers';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gt_event';
    }
    
    public function behaviors(){
        $b = parent::behaviors();
        $b['cleanCache'] = [
            'class'=>'app\behaviors\CleanCacheBehavior',
            'cacheKey'=>self::CacheKey
        ];
        return $b;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'code'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'code'], 'string', 'max' => 64],
            [['intro'], 'string', 'max' => 255],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => '添加时间',
            'updated_at' => '更新时间',
            'name' => '名称',
            'code' => '编码',
            'intro' => '介绍',
        ];
    }

    /**
     * {@inheritdoc}
     * @return EventQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EventQuery(get_called_class());
    }
    
    /**
     * 获取事件的所有处理器
     * @param string $eventName
     * @return NULL|array
     */
    public static function getEventHandlers($eventName) {
        if(!($handlersMap = Yii::$app->cache->get(self::CacheKey))){
            $query = new Query();
            $handlersMap = [];
            $handlers = $query->select('e.code,h.handler')->from(['e'=>Event::tableName()])
            ->innerJoin(['h'=>EventHandler::tableName()],'e.id = h.event_id')->all();
            if($handlers){
                foreach($handlers as  $handler){
                    if(!isset($handlersMap[$handler['code']])){
                        $handlersMap[$handler['code']]=[];
                    }
                    $handlersMap[$handler['code']][] = $handler['handler'];
                }
            }
            Yii::$app->cache->add(self::CacheKey, $handlersMap);
        }
        return isset($handlersMap[$eventName])?$handlersMap[$eventName]:null;
    }
    
    public static function triggerCustomEvent($eventName,$params=[]){
        $handlers = self::getEventHandlers($eventName);
        if(is_array($handlers)) {
            foreach($handlers as $handler) {
                call_user_method('process', new $handler(),$params);
            }
        }
    }
}
