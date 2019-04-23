<?php
namespace app\core;

class ListModelsAction extends BaseAction
{
    public function run()
    {
        $searchModel = \Yii::createObject($this->modelClass);
        $dataProvider = $searchModel->search($this->composeGetParams($searchModel));
        return $this->controller->render($this->viewName, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }
}

