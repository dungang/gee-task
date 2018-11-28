<?php
namespace app\core;

use Yii;

class UpdateModelsAction extends BaseAction
{

    public function run($id)
    {
        /* @var $model \yii\db\ActiveRecord */
        /* @var $models \yii\db\ActiveRecord[] */
        $ids = explode(',', $id);
        $models = $this->findModels($ids);
        $data = [
            'models'=>$models
        ];
        try {
            Yii::$app->db->transaction(function ($db) use ($models) {
                foreach ($models as $model) {
                    $model->load(\Yii::$app->request->post()) && $model->save(false);
                }
                return $this->controller->redirectOnSuccess(\Yii::$app->request->referrer,"修改成功");
            });
        } catch (\Exception $e) {  
            Yii::warning($e->getTraceAsString());
            return $this->controller->renderOnException($this->id,$data);
            
        }

        return $this->controller->renderOnSuccess($this->id,$data);
    }
}

