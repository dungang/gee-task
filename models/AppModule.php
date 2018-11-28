<?php
namespace app\models;

class AppModule extends  AuthItem
{

    public function init() {
        //类型默认为模块
        $this->type = parent::TYPE_MODULE;
    }
    
}

