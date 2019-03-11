<?php
namespace app\webchat;

use app\core\ILongPollHandler;
use app\models\Setting;
use app\models\Wechat;
use yii\base\BaseObject;
use yii\helpers\Json;

/**
 * 循环执行微信同步
 *
 * @author dungang
 *        
 */
class LoopHandler extends BaseObject implements ILongPollHandler
{

    protected $api;

    public function init()
    {
        $this->api = new Api();
    }

    public function process()
    {
        //检查状态，是否开关已经关闭
        $ignore = false;
        if($status = Setting::findOne(['name'=>'wechat.loop.status'])){
            //很久没变更时间了，表示停止了
            $ignore = ($status->value + 0) < 1;
        } else {
            $ignore = true;
        }
        if(!$ignore) {
            if ($wechats = Wechat::findAll([
                'status' => 'RUN'
            ])) {
                foreach ($wechats as $wechat) {
                    $data = Json::decode($wechat->data);
                    if ($this->api->syncCheck($data) < 0) {
                        $wechat->status = 'STOP';
                    } else {
                        $wechat->traced_at = time();
                    }
                    $wechat->save(false);
                }
            }
            
        }
        //最后运行时间
        if(!($trace = Setting::findOne(['name'=>'wechat.loop.traced_at']))){
            $ignore = true;
        }
        $trace->value = time();
        $trace->save(false);
        return $ignore;
    }
}

