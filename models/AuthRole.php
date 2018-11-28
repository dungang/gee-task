<?php
namespace app\models;

class AuthRole extends AuthItem
{
    public function init(){
        $this->type = parent::TYPE_ROLE;
    }
}

