<?php
namespace modules\aliyunlog\models;

class LogSearch extends DataSearch
{

    /**
     * 日志api请求的响应结果
     *
     * @var \Aliyun_Log_Models_GetLogsResponse
     */
    protected $response;

    public function init()
    {
        parent::init();
        $this->key = 'time';
    }

    public function search($param)
    {
        if ($this->client) {
            $this->load($param);

            $request = new \Aliyun_Log_Models_GetLogsRequest($this->projectName, $this->logstoreName, strtotime($this->from), strtotime($this->to), $this->topic, $this->query, $this->line, $this->offset, $this->reverse);
            $this->response = $this->client->getLogs($request);
        }
    }

    public function getModels()
    {
        if ($this->client) {
            return array_map(function ($item) {
                $content = $item->getContents();
                return new Log([
                    'time' => $item->getTime(),
                    'ip' => $item->getSource(),
                    'level' => $content['level'],
                    'location' => isset($content['location']) ? $content['location'] : '',
                    'thread' => $content['thread'],
                    'topic' => $content['__topic__'],
                    'message' => $content['message']
                ]);
            }, array_reverse($this->response->getLogs()));
        }
        return [];
    }

    public function getCount()
    {
        if ($this->client) {
            return $this->response->getCount();
        }
        return 0;
    }
}

