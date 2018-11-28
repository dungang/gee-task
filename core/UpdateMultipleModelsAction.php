<?php
namespace app\core;

use Yii;
use yii\base\Model;

class UpdateMultipleModelsAction extends BaseAction
{

    public $formName;

    public function run($id)
    {
        $ids = explode(',', $id);
        $models = $this->findModels($ids);
        foreach ($models as $model) {
            $model->load(Yii::$app->request->queryParams);
        }
        $data = [
            'models' => $models
        ];
        if (($loaded = Model::loadMultiple($models, Yii::$app->request->post())) && Model::validateMultiple($models)) {
            try {
                Yii::$app->db->transaction(function ($db) use ($models) {
                    foreach ($models as $model) {
                        $model->save(false);
                    }
                });

                return $this->controller->redirectOnSuccess(\Yii::$app->request->referrer, "修改成功");
            } catch (\Exception $e) {

                Yii::warning($e->getTraceAsString());
                return $this->controller->renderOnException($this->id, $data);
            }
        }

        if (\Yii::$app->request->isPost) {
            if ($loaded === false) {
                return $this->controller->renderOnFail($this->id, $data, '可能表达的字段更服务端不一致');
            }
            return $this->controller->renderOnFail($this->id, $data);
        }

        return $this->controller->render($this->id, $data);
    }
}

