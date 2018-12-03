<?php

require_once realpath(dirname(__FILE__) . '/Response.php');

class Aliyun_Log_Models_ListProjectResponse extends Aliyun_Log_Models_Response 
{
    private $count;
    
    private $total;
    
    private $projects;
    
    public function __construct($resp, $header) {
        parent::__construct ( $header );
        $this->count = $resp['count'];
        $this->total = $resp['total'];
        $this->projects = $resp['projects'];
    }
    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @return mixed
     */
    public function getProjects()
    {
        return $this->projects;
    }

    /**
     * @param mixed $count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }

    /**
     * @param mixed $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * @param mixed $projects
     */
    public function setProjects($projects)
    {
        $this->projects = $projects;
    }

    
    
}

