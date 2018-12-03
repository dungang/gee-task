<?php
namespace modules\aliyunlog\models;

class ProjectLogSearch extends DataSearch
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

    public function getQuery($logstore, $starttime, $endtime)
    {
        return "Select * From $logstore Where __date__ <'$starttime' AND __date__ > '$endtime'";
    }

    public function search($param)
    {
        if ($this->client) {
            $this->load($param);

            $request = new \Aliyun_Log_Models_GetProjectLogsRequest($this->projectName, $this->getQuery($this->logstoreName, $this->to, $this->from));
            $this->response = $this->client->getProjectLogs($request);
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
            }, $this->response->getLogs());
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
