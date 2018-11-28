<?php
namespace app\core;

use Yii;

class DeleteModelsAction extends BaseAction
{

    public $redirect = null;

    public function init()
    {
        if (null === $this->redirect) {
            $this->redirect = \Yii::$app->request->referrer;
        }
    }

    public function run($id)
    {
        /* @var $model \yii\db\ActiveRecord */
        /* @var $models \yii\db\ActiveRecord[] */
        $ids = explode(',', $id);
        $models = $this->findModels($ids);

        try {
            Yii::$app->db->transaction(function ($db) use ($models) {
                foreach ($models as $model) {
                    $model->delete();
                }
            });
        } catch (\Exception $e) {
            Yii::warning($e->getMessage());
            return $this->controller->redirectOnFail($this->redirect);
        }
        return $this->controller->redirectOnSuccess($this->redirect);
    }
}

