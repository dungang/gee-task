<?php
namespace modules\robot\handlers;

use app\core\CustomEventHandler;
use yii\db\Query;
use app\models\Robot;
use modules\robot\models\ProjectRobot;
use app\helpers\MiscHelper;
use app\models\RobotMessage;
use yii\base\BaseObject;

abstract class RobotSendMessageHandler extends BaseObject implements CustomEventHandler
{
    
    /**
     * 消息模板编码，并不是表示每个消息都需要模板。在robot_message表种配置
     * @var string
     */
    public $msg_code;
    
    /**
     * 传递对象实例
     * @var array
     */
    public static $models = [];
    
    public static function addModelChain($name,$model){
        self::$models[$name] = $model;
    }
    
    public function getMsgTmpl() {
        if($tmpl = RobotMessage::getMessageTempateByCode($this->msg_code)){
            return $tmpl;
        }
        return false;
    }
    
    /**
     * 获取本次要发送的消息
     * 子类需要实现的方法
     * @param mixed $data
     * @return array  [title,body]
     */
    protected abstract function getMessage($data);

    /**
     * 机器人处理消息的实现
     * {@inheritDoc}
     * @see \app\core\CustomEventHandler::process()
     */
    public final function process($data)
    {
        $query = new Query();
        $robots = $query->select('r.code_full_class,p.webhook')
            ->from([
            'r' => Robot::tableName()
        ])
            ->innerJoin([
            'p' => ProjectRobot::tableName()
        ], 'r.id=p.robot_id')
            ->where([
            'p.project_id' => MiscHelper::getProjectId()
        ])
            ->all();
        if (is_array($robots)) {
            list($title,$body) = $this->getMessage($data);
            if($title && $body) {
                foreach ($robots as $robot) {
                    /* @var $rb \app\core\RobotSender */
                    $rb = \Yii::createObject($robot['code_full_class']);
                    $rb->webhook = $robot['webhook'];
                    $rb->sendMessage($title,$body);
                }
            }
            
        }
    }
}

