<?php
namespace modules\aliyunlog\controllers;

use modules\aliyunlog\models\ProjectSearch;
use modules\aliyunlog\components\AliyunLogDataProvider;
use app\helpers\MiscHelper;

/**
 * 日志项目管理
 * @author dungang
 *
 */
class DefaultController extends LogController
{
    
    public function init(){
        parent::init();
        $this->userActions = ['index','setting'];
    }
    
    /**
     * 显示创建的项目
     */
    public function actionIndex(){
        $client = $this->getLogClient();
        $search = new ProjectSearch(['client'=>$client]);
        $search->search(\Yii::$app->request->queryParams);
        return $this->render("index",[
            'dataProvider'=>new AliyunLogDataProvider([
                'search' => $search
            ])
        ]);
    }
    
    public function actions(){
        $project_id = MiscHelper::getProjectId();
        return [
            'setting'=> [
                'class' => 'app\core\UpdateModelAction',
                'modelClass' => [
                    'class' => 'modules\aliyunlog\models\AliyunLog',
                    'project_id'=>$project_id,
                ],
                'createOneOnNotFound'=>true,
                
            ],
        ];
    }
   
}

