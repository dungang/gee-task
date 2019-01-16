<?php
namespace app\core;

class ListModelsAction extends BaseAction
{
    public function run(){
        
        $searchModel = \Yii::createObject($this->modelClass);
        
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        
        return $this->controller->render($this->defaultView, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}

