<?php

class Aliyun_Log_Models_ListProjectRequest
{
    private $offset = 0;
    
    private $size = 10;
    
    public function __construct($offset=0,$size=10) {
        $this->offset = $offset;
        $this->size = $size;
    }
    /**
     * @return number
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @return number
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param number $offset
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
    }

    /**
     * @param number $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    
    
}

