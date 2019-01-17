<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gt_robot_message".
 *
 * @property int $id
 * @property string $code 消息代号
 * @property string $name 消息名称
 * @property string $msg_subject 消息主题
 * @property string $subject_vars 主题变量
 * @property string $msg_body 消息内容
 * @property string $body_vars 内容变量
 */
class RobotMessage extends \app\core\BaseModel
{
    const CacheKey = "robot.message.templates";
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gt_robot_message';
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
            [['msg_body'], 'string'],
            [['code', 'name'], 'string', 'max' => 64],
            [['msg_subject', 'subject_vars', 'body_vars'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => '消息代号',
            'name' => '消息名称',
            'msg_subject' => '消息主题',
            'subject_vars' => '主题变量',
            'msg_body' => '消息内容',
            'body_vars' => '内容变量',
        ];
    }

    /**
     * {@inheritdoc}
     * @return RobotMessageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RobotMessageQuery(get_called_class());
    }
    
    /**
     * 获取消息的所有模板，并缓存
     * @param string $msg_code 模板编号
     * @return NULL|array|object
     */
    public static function getMessageTempateByCode($msg_code) {
        if(!($handlersMap = Yii::$app->cache->get(self::CacheKey))){
            $handlersMap = self::find()->indexBy('code')->all();
            Yii::$app->cache->add(self::CacheKey, $handlersMap);
        }
        return isset($handlersMap[$msg_code])?$handlersMap[$msg_code]:null;
    }
}
