<?php
namespace modules\aliyunlog\models;

class LogStoreSearch extends DataSearch
{

    /**
     * 日志api请求的响应结果
     *
     * @var \Aliyun_Log_Models_ListLogstoresResponse
     */
    protected $response;

    public function init()
    {
        $this->key = 'logstoreName';
    }

    public function search($param)
    {
        if ($this->client) {
            $request = new \Aliyun_Log_Models_ListLogstoresRequest($param['projectName']);
            $this->response = $this->client->listLogstores($request);
            $this->projectName = $param['projectName'];
        }
    }

    public function getModels()
    {
        if ($this->client) {
            return array_map(function ($item) {
                return new LogStore([
                    'logstoreName' => $item,
                    'projectName' => $this->projectName
                ]);
            }, $this->response->getLogstores());
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

