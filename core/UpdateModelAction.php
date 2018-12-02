<?php
namespace app\core;

use Yii;
use yii\bootstrap\ActiveForm;
use yii\web\Response;

class UpdateModelAction extends BaseAction
{
    public function run()
    {
        
        /* @var $model \yii\db\ActiveRecord */
        $model = $this->findModel();
        $model->getPrimaryKey();
        $model->load(\Yii::$app->request->queryParams);
        $data = [
            'model' => $model
        ];
        
        
        //ajax表单验证
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        
        //动态绑定行为
        $model->attachBehaviors($this->modelBehaviors);
        if (($loaded = $model->load(\Yii::$app->request->post())) && $model->save()) {
            if(!$this->successRediretUrl) {
                $this->successRediretUrl = \Yii::$app->request->referrer;
            }
            return $this->controller->redirectOnSuccess($this->successRediretUrl, "修改成功");
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

