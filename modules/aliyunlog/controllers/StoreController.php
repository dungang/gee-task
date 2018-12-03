<?php
namespace modules\aliyunlog\controllers;

use modules\aliyunlog\components\AliyunLogDataProvider;
use modules\aliyunlog\models\LogStoreSearch;

class StoreController extends LogController
{
    
    public function init(){
        parent::init();
        $this->userActions = ['index'];
    }
    
    /**
     * 显示创建的项目
     */
    public function actionIndex(){
        $client = $this->getLogClient();
        $search = new LogStoreSearch(['client'=>$client]);
        $search->search(\Yii::$app->request->queryParams);
        return $this->render("index",[
            'dataProvider'=>new AliyunLogDataProvider([
                'search' => $search
            ])
        ]);
    }
 
}

