<?php
namespace app\core;

class DeleteModelAction extends BaseAction
{
    public $redirect = null;
    
    public function init(){
        if(null === $this->redirect) {
            $this->redirect = \Yii::$app->request->referrer;
        }
    }
    
    public function run($id)
    {
        /*@var $model \yii\db\ActiveRecord */
        $model = $this->findModel($id);
        if($model->delete()===false){
            return $this->controller->redirectOnFail($this->redirect);
        } else {
            return $this->controller->redirectOnSuccess($this->redirect);
        }
        
    }
}

