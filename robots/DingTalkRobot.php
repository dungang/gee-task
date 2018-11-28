<?php
namespace app\robots;

use yii\base\BaseObject;
use yii\httpclient\Client;
use yii\httpclient\Request;
use app\core\RobotSender;

/**
 * 钉钉机器人
 *
 * @author dungang
 *        
 */
class DingTalkRobot extends BaseObject implements RobotSender
{

    public $webhook;

    /**
     * 消息标题
     *
     * @var string
     */
    public $title;

    /**
     *
     * @var string|array
     */
    public $msg;

    /**
     * 图片地址
     *
     * @var string
     */
    public $picUrl = "";

    /**
     * 消息文档地址
     *
     * @var string
     */
    public $messageUrl = "";

    /**
     *
     * @var string
     */
    public $msg_type = 'markdown';

    /**
     *
     * @var boolean|array
     */
    public $atMobiles = false;

    /**
     *
     * @var boolean
     */
    public $isAll = false;

    /**
     * 请求对象
     *
     * @var Request
     */
    private $_request;

    /**
     *
     * {@inheritdoc}
     * @see \yii\base\BaseObject::__construct()
     */
    public function __construct($config = array())
    {
        parent::__construct($config);
        
        $this->_request = (new Client())->createRequest();
       
    }

    /**
     * 文本消息
     *
     * @return string[]|string[][]|array[][]|boolean[][]
     */
    public function textMsg()
    {
        return [
            'msgtype' => $this->msg_type,
            $this->msg_type => [
                'content' => $this->msg
            ],
            'at' => [
                'atMobiles' => $this->atMobiles,
                'isAll' => $this->isAll
            ]
        ];
    }

    public function markdownMsg()
    {
        $ats = $this->createAts($this->atMobiles);
        $msg = $this->msg . "\n\n".$ats;
        return [
            'msgtype' => $this->msg_type,
            $this->msg_type => [
                'title'=>$this->title,
                'text' => '### ' . $this->title . "\n\n" . $msg
            ],
            'at' => [
                'atMobiles' => $this->atMobiles,
                'isAll' => $this->isAll
            ]
        ];
    }

    public function linkMsg()
    {
        return [
            'msgtype' => $this->msg_type,
            $this->msg_type => [
                'title' => $this->title,
                'text' => $this->msg,
                'picUrl' => $this->picUrl,
                'messageUrl' => $this->messageUrl
            ],
            'at' => [
                'atMobiles' => $this->atMobiles,
                'isAll' => $this->isAll
            ]
        ];
    }
    
    protected function createAts($mobiles) {
        if(is_array($this->atMobiles) && count($this->atMobiles)) {
            return implode(" ", array_map(function($mobile){
                return '@'.$mobile;
            }, $this->atMobiles));
        }
    }

    /**
     * 发送消息
     *
     * @param string $msg
     * @param boolean|array $atMobiles
     * @param boolean $isAll
     */
    public function sendMessage($title,$msg,$mobiles)
    {
        $this->msg = $msg;
        $this->atMobiles = $mobiles;
        $this->title = $title;
        $fullMsg = false;
        if ($this->msg_type == 'text') {
            $fullMsg = $this->textMsg();
        } else if ($this->msg_type == 'markdown') {
            $fullMsg = $this->markdownMsg();
        } else if ($this->msg_type == 'link') {
            $fullMsg = $this->linkMsg();
        }
        if ($fullMsg) {
            $this->_request->setUrl($this->webhook)
                ->addHeaders([
                'content-type' => 'application/json'
            ])
                ->setContent(json_encode($fullMsg))
                ->setMethod('post')
                ->send();
        }
    }
}

