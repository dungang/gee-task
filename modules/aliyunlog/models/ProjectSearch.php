<?php
namespace modules\aliyunlog\models;

class ProjectSearch extends DataSearch
{

    /**
     * 日志api请求的响应结果
     *
     * @var \Aliyun_Log_Models_ListProjectResponse
     */
    protected $response;

    public function init()
    {
        $this->key = 'projectName';
    }

    public function search($param)
    {
        if ($this->client) {
            $request = new \Aliyun_Log_Models_ListProjectRequest();
            $this->response = $this->client->listProject($request);
        }
    }

    public function getModels()
    {
        if ($this->client) {
            return array_map(function ($item) {
                return new Project($item);
            }, $this->response->getProjects());
        }
        return [];
    }

    public function getCount()
    {
        if ($this->client) {
            return $this->response->getTotal();
        }
        return 0;
    }
}

