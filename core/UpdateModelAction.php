<?php
namespace app\core;

class UpdateModelAction extends BaseAction
{
    public function run($id)
    {
        /* @var $model \yii\db\ActiveRecord */
        $model = $this->findModel($id);
        $model->load(\Yii::$app->request->queryParams);
        $data = [
            'model' => $model
        ];
        if (($loaded = $model->load(\Yii::$app->request->post())) && $model->save()) {
            return $this->controller->redirectOnSuccess(\Yii::$app->request->referrer,"修改成功");
        }
        
        if (\Yii::$app->request->isPost) {
            if($loaded === false) {
                return $this->controller->renderOnFail($this->id,$data,'可能表达的字段更服务端不一致');
            }
            return $this->controller->renderOnFail($this->id,$data);
        }
        
        return $this->controller->render($this->id, $data);
    }
}

