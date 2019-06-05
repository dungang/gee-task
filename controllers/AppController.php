<?php
namespace app\controllers;

use app\filters\SwitchProjectFilter;
use app\core\BaseController;
use app\filters\SaveRouteFilter;
use app\filters\AccessFilter;
use app\helpers\MiscHelper;

abstract class AppController extends BaseController
{
    /**
     * 项目id
     * @var int
     */
    public $project_id;
    
    public function init(){
        parent::init();
        $this->layout = '/project';
        $this->project_id = MiscHelper::getProjectId();
    }
    
    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors[SwitchProjectFilter::FILTER_SWITCH_PROJECT] = SwitchProjectFilter::className();
        if(YII_ENV_DEV) $behaviors['saveRoute'] = SaveRouteFilter::className();
        $behaviors[AccessFilter::ID] = [
            'class'=>AccessFilter::className(),
            'isAdmin'=>false,
        ];
        return $behaviors;
    }
    
}

