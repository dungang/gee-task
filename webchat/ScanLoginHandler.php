<?php
namespace app\webchat;

use app\core\ILongPollHandler;
use app\models\Wechat;
use yii\helpers\Json;

class ScanLoginHandler implements ILongPollHandler
{

    protected $api;

    protected $tip = 0;

    protected $uuid;

    protected $id;

    public function process()
    {
        if (empty($this->api)) {
            $this->api = new Api();
            $this->tip = \Yii::$app->request->get('tip', 0);
            $this->uuid = \Yii::$app->request->get('uuid', false);
            $this->id = \Yii::$app->request->get('id', 0);
        }
        $data = [
            'timestamp' => time(),
            'data' => ''
        ];

        if ($this->id) {
            $cookies = null;
            if ($wechat = Wechat::findOne([
                'id' => $this->id
            ])) {
                $wechat_data = empty($wechat->data) ? [] : Json::decode($wechat->data);
                // 半小时没有跟新则表示失效
                if ($wechat->status == 'RUN' && ($wechat->traced_at + 1800) < time()) {
                    $cookies = isset($wechat_data['cookie']) ? $wechat_data['cookie'] : null;
                } else if ($wechat->status == 'RUN') {
                    $wechat->status = 'STOP';
                    $wechat->save(false);
                }
                if (empty($cookies) && $this->uuid) {
                    // 获取数据获取的url
                    if ($url = $this->api->scanLogin($this->uuid, $this->tip)) {
                        // 获取后续使用的cookie 数据
                        if ($cookie_data = $this->api->getCookie($url)) {
                            $wechat_data['deviceId'] = $cookie_data['deviceid'];
                            $wechat_data['cookie'] = $cookie_data['cookie'];
                            $wechat_data['base'] = $cookie_data['base'];
                            $wechat_data['uuid'] = $this->uuid;
                            // 获取用户信息，包括同步信息
                            $info = $this->api->webWxInit($wechat_data);
                            $wechat_data['synckey'] = $info['SyncKey'];
                            $wechat_data['self'] = $info['User'];
                            $wechat->data = Json::encode($wechat_data);
                            $wechat->save(false);
                            $data['cookie'] = $wechat_data['cookie'];
                            $data['user'] = $wechat_data['self'];
                        }
                    }
                }
            }
        }
        return json_encode($data);
    }
}

