<?php
namespace app\webchat;

use yii\base\Component;
use yii\httpclient\Client;
use yii\web\Cookie;
use yii\helpers\Json;

/**
 * web微信协议api
 *
 * @author dungang
 *        
 */
class Api extends Component
{

    protected $client;

    const SESSION_UUID = 'webchat-uuid';

    const APP_ID = 'wx782c26e4c19acffb';

    public function init()
    {
        $this->client = new Client();
        $this->client->requestConfig = [
            'options' => [
                'sslVerifyPeer' => false,
                'sslVerifyHost' => false,
                'followLocation' => 0,
                'maxRedirects' => 0
            ],
            'headers' => [
                // 'Host' => 'wx.qq.com',
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:64.0) Gecko/20100101 Firefox/64.0',
                'Accept' => '*/*',
                'Accept-Language' => 'zh-CN,zh;q=0.8,zh-TW;q=0.7,zh-HK;q=0.5,en-US;q=0.3,en;q=0.2',
                // 'Accept-Encoding' => 'gzip, deflate, br',
                // 'Connection' => 'keep-alive',
                // 'Upgrade-Insecure-Requests' => '1',
                // 'Cache-Control' => 'max-age=0',
                // 'Content-Type' => 'text/html;charset=utf-8',
                'Referer' => 'https://wx.qq.com/'
            ]
        ];

        // $this->client->on(Client::EVENT_BEFORE_SEND, function ($event) {
        // if($cookies = \Yii::$app->cache->get('webchat.cookie')) {
        // //\var_dump($cookies->toArray());die;
        // $event->request->addCookies($cookies);
        // }
        // });
        // $this->client->on(Client::EVENT_AFTER_SEND, function ($event) {
        // \Yii::$app->cache->set('webchat.cookie',$event->response->getCookies()->toArray());
        // });
    }

    /**
     * https://login.wx.qq.com/jslogin?appid=wx782c26e4c19acffb&redirect_uri=https%3A%2F%2Fwx.qq.com%2Fcgi-bin%2Fmmwebwx-bin%2Fwebwxnewloginpage&fun=new&lang=zh_CN&_=1476606163580
     *
     * <pre>
     * appid：固定为wx782c26e4c19acffb
     * redirect_rui：https://wx.qq.com/cgi-bin/mmwebwx-bin/webwxnewloginpage经过url编码
     * fun：固定值new
     * lang：语言类型，中国zh_CN
     * _：当前的unix时间戳
     * </pre>
     */
    public function getUuid()
    {
        $rsp = $this->client->get('https://login.wx.qq.com/jslogin', [
            'appid' => self::APP_ID,
            'redirect_rui' => 'https://wx.qq.com/cgi-bin/mmwebwx-bin/webwxnewloginpage',
            'fun' => 'new',
            'lang' => 'zh_CN',
            '_' => time()
        ])->send();
        if ($rsp->isOk) {
            if ($content = $rsp->getContent()) {
                $matches = [];
                // window.QRLogin.code = 200; window.QRLogin.uuid = "wcYXG6fssA==";
                preg_match('#(\d+);.*?"(.*?)";#si', $content, $matches);
                if (count($matches) > 0 && $matches[1] == 200) {
                    return $matches[2];
                }
            }
        }
        return null;
    }

    /**
     * https://login.weixin.qq.com/qrcode/gf5Gk61zEA==
     *
     * @param string $uuid
     */
    public function getQrCode($uuid)
    {
        $rsp = $this->client->get('https://login.weixin.qq.com/qrcode/' . $uuid)->send();
        return $rsp->content;
    }

    /**
     * https://login.wx.qq.com/cgi-bin/mmwebwx-bin/login?loginicon=true&uuid=gf5Gk61zEA==&tip=0&r=862560455&_=1476606163582
     */
    public function scanLogin($uuid, $tip = 0)
    {
        $rsp = $this->client->get('https://login.wx.qq.com/cgi-bin/mmwebwx-bin/login', [
            'loginicon' => true,
            'uuid' => $uuid,
            'tip' => $tip,
            '_' => time()
        ])->send();
        // return $rsp->getCookies();
        // return $rsp->getContent();
        if ($rsp->isOk) {
            if ($content = $rsp->getContent()) {
                $matches = [];
                // window.code=408;//登录超时code为408
                // window.code=201;window.userAvatar = 'data:img/jpg;base64';//扫描成功 201，userAvatar为用户头像
                // window.code=200;//确认登录code 200， 还有下面的redirect_uri的获取cookie的连接
                // window.redirect_uri="https://wx.qq.com/cgi-bin/mmwebwx-bin/webwxnewloginpage?ticket=AYfheMIH6tt9EmcZ0DxCKF4a@qrticket_0&uuid=YeGrrvqmHQ==&lang=zh_CN&scan=1476606728";
                // 只检查成功的状态
                preg_match('#(\d+);.*?"(.*?)";#si', $content, $matches);
                if (count($matches) > 0 && $matches[1] == 200) {
                    // return $rsp->getCookies();
                    return $matches[2];
                }
            }
        }
        return null;
    }

    /**
     * 登录后获取cookie信息
     * https://wx.qq.com/cgi-bin/mmwebwx-bin/webwxnewloginpage?ticket=AYfheMIH6tt9EmcZ0DxCKF4a@qrticket_0&uuid=YeGrrvqmHQ==&lang=zh_CN&scan=1476606728&fun=new&version=v2&lang=zh_CN
     */
    public function getCookie($url)
    {
        $rsp = $this->client->get($url . "&fun=new&version=v2")
            ->addCookies([
            new Cookie([
                'domain' => 'wx.qq.com',
                'name' => 'MM_WX_NOTIFY_STATE',
                'value' => 1,
                'httpOnly' => false
            ]),
            new Cookie([
                'domain' => 'wx.qq.com',
                'name' => 'MM_WX_SOUND_STATE',
                'value' => 1,
                'httpOnly' => false
            ])
        ])
            ->send();
        if ($rsp->isOk) {
            $cookies = [];
            foreach ($rsp->cookies->toArray() as $cookie) {
                $cookies[] = [
                    'name' => $cookie->name,
                    'value' => $cookie->value,
                    'domain' => $cookie->domain,
                    'path' => $cookie->path,
                    'secure' => $cookie->secure,
                    'expire' => $cookie->expire,
                    'httpOnly' => $cookie->httpOnly
                ];
            }
            return [
                'deviceid' => 'e' . substr(md5(uniqid()), 2, 15),
                'cookie' => $cookies,
                'base' => (array) simplexml_load_string($rsp->content, 'SimpleXMLElement', LIBXML_NOCDATA)
            ];
        }
        return null;
    }

    /**
     * 心跳检查
     * <pre>
     * 1.通过初始化获取第一次同步的synckeys;
     * 2.以后通过websync的结果获取synckeys;
     * 3.请求带上初始化获得的cookie
     * </pre>
     */
    public function syncCheck($data)
    {
        if ($synckey = $data['synckey'] && $cookie = $data['cookie'] && $base = $data['base']) {
            $t = time();
            $rsp = $this->client->get('https://webpush.wx.qq.com/cgi-bin/mmwebwx-bin/synccheck', [
                'r' => $t,
                'skey' => $base['skey'],
                'sid' => $base['wxsid'],
                'uid' => $base['wxuin'],
                'deviceid' => $this->getDeviceId(),
                'synckey' => $this->formatSyncKeys($synckey['List']),
                '_' => $t
            ])
                ->addHeaders([
                'Content-Type' => 'text/javascript'
            ])
            ->addCookies($this->formatCookies($cookie))
                ->send();
            if ($rsp->isOk) {
                $matches = [];
                preg_match('#retcode:"(\d+)",selector:"(\d+)"#', $rsp->content, $matches);
                if (count($matches) > 0 && $matches[1] == 0) {
                    return $matches[2];
                } else {
                    return - 1;
                }
            }
        }
        return 0;
    }

    public function webSync($data)
    {
        if ($synckey = $data['synckey'] && $cookie = $data['cookie'] && $base = $data['base']) {
            $t = time();
            $q = http_build_query([
                'skey' => $base['skey'],
                'sid' => $base['wxsid'],
                'pass_ticket' => $base['pass_ticket'],
                '_' => $t
            ]);
            $rsp = $this->client->post('https://wx.qq.com/cgi-bin/mmwebwx-bin/webwxsync?' . $q, [
                'BaseRequest' => $this->getBaseRequest($base),
                'SyncKey' => $synckey,
                'rr' => ~ $t
            ], $this->jsonContentTypeHearders())
                ->addCookies($this->formatCookies($cookie))
                ->setFormat(Client::FORMAT_JSON)
                ->send();
            if ($rsp->isOk) {
                return Json::decode($rsp->content);
            }
        }
        return null;
    }

    /**
     * 获取用户信息，实际调用 “微信初始化请求”
     * https://wx.qq.com/cgi-bin/mmwebwx-bin/webwxinit
     */
    public function webWxInit($data)
    {
        if ($base = $data['base']) {
            if (isset($base['wxuin']) && isset($base['wxsid']) && isset($base['skey'])) {
                $rsp = $this->client->post('https://wx.qq.com/cgi-bin/mmwebwx-bin/webwxinit', [
                    'BaseRequest' => $this->getBaseRequest($base)
                ], $this->jsonContentTypeHearders())
                    ->setFormat(Client::FORMAT_JSON)
                    ->addCookies($this->formatCookies($data['cookie']))
                    ->send();
                if ($rsp->isOk) {
                    return Json::decode($rsp->content);
                }
            }
        }

        return null;
    }

    /**
     * 获取群列表
     *
     * @param array $data
     * @return array|NULL
     */
    public function getChatRoom($data)
    {
        if ($base = $data['base']) {
            $t = time();
            $rsp = $this->client->get('https://wx.qq.com/cgi-bin/mmwebwx-bin/webwxgetcontact' . http_build_query([
                'skey' => $base['skey'],
                'seq' => 0,
                'pass_ticket' => $base['pass_ticket'],
                '_' => $t
            ]))->send();
            if ($rsp->isOk) {
                $contact_data = Json::decode($rsp->content);
                if ($contacts = $contact_data['MemberList']) {
                    // 获取群
                    return array_filter($contacts, function ($contact) {
                        return strpos($contact['UserName'], '@@') !== false;
                    });
                }
            }
        }
        return null;
    }

    /**
     * 发送文本消息
     *
     * @param string $self
     * @param string $toUserName
     * @param string $message
     * @param array $data
     * @return mixed|NULL
     */
    public function sendTextMessage($self, $toUserName, $message, $data)
    {
        if ($base = $data['base']) {
            if (isset($base['wxuin']) && isset($base['wxsid']) && isset($base['skey'])) {
                $localId = (time() * 1000) . substr(uniqid(), 0, 5);
                $rsp = $this->client->post('https://wx.qq.com/cgi-bin/mmwebwx-bin/webwxinit', [
                    'BaseRequest' => $this->getBaseRequest($base),
                    'Msg' => [
                        'Type' => 1,
                        'Content' => $message,
                        'FromUserName' => $self,
                        'ToUserName' => $toUserName,
                        'LocalID' => $localId,
                        'ClientMsgId' => $localId
                    ],
                    'Scene' => 0
                ], $this->jsonContentTypeHearders())
                    ->setFormat(Client::FORMAT_JSON)
                    ->send();
                if ($rsp->isOk) {
                    return Json::decode($rsp->content);
                }
            }
        }
        return null;
    }

    protected function getDeviceId()
    {
        return 'e' . substr(md5(uniqid()), 2, 15);
    }

    protected function formatSyncKeys($keys)
    {
        $synckeys = [];
        foreach ($keys as $key) {
            $synckeys[] = $key['Key'] . '_' . $key['Val'];
        }
        return implode('|', $synckeys);
    }

    protected function jsonContentTypeHearders()
    {
        return [
            'Content-Type' => 'application/json;charset=utf-8'
        ];
    }

    protected function getBaseRequest($base)
    {
        return [
            'Uin' => $base['wxuin'],
            'Sid' => $base['wxsid'],
            'Skey' => $base['skey'],
            'DeviceID' => $this->getDeviceId() // $data['deviceid']
        ];
    }

    protected function formatCookies($cookies)
    {
        $cookieCollection = [];
        foreach ($cookies as $cookie) {
            $cookieCollection[] = new Cookie($cookie);
        }
        return $cookieCollection;
    }
}

