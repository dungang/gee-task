<?php
namespace app\controllers;

use app\core\BaseController;
use app\filters\AccessFilter;
use app\filters\SaveRouteFilter;

abstract class AdminController extends BaseController
{

    public function behaviors() {
        $behaviors = parent::behaviors();
        if(YII_ENV_DEV) $behaviors['saveRoute'] = SaveRouteFilter::className();
        $behaviors[AccessFilter::ID] = AccessFilter::className();
        return $behaviors;
    }
}

