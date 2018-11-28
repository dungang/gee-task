<?php
namespace app\commands;
use yii\console\Controller;
use yii\helpers\Html;

class SerializeController extends Controller
{
    
    public function actionIndex(){
        //echo serialize(new User());
       echo  Html::a('index','index',['data-pjax'=>'0']);
    }
}

