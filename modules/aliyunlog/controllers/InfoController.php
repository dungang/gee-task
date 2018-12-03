<?php
namespace modules\aliyunlog\controllers;

use modules\aliyunlog\models\LogSearch;
use modules\aliyunlog\components\AliyunLogDataProvider;
use modules\aliyunlog\models\ProjectLogSearch;

/**
 * 查询日志
 *
 * @author dungang
 *        
 */
class InfoController extends LogController
{
    public function init(){
        parent::init();
        $this->userActions = ['index','project-log'];
    }

    /**
     * 显示日志
     */
    public function actionIndex()
    {
        $client = $this->getLogClient();
        $search = new LogSearch([
            'client' => $client
        ]);
        $search->search(\Yii::$app->request->queryParams);
        return $this->render("index", [
            'searchModel'=>$search,
            'dataProvider' => new AliyunLogDataProvider([
                'search' => $search,
                'pagination'=>false,
            ])
        ]);
    }
    
    
    /**
     * 显示创建的项目
     */
    public function actionProjectLog(){
        $client = $this->getLogClient();
        $search = new ProjectLogSearch(['client'=>$client]);
        $search->search(\Yii::$app->request->queryParams);
        return $this->render("index",[
            'searchModel'=>$search,
            'dataProvider'=>new AliyunLogDataProvider([
                'search' => $search,
                'pagination'=>false,
            ])
        ]);
    }
}

