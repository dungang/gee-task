<?php
namespace app\core;

class ViewModelAction extends BaseAction
{
    public function run()
    {
        $model = $this->findModel();
        // 动态绑定行为
        $model->attachBehaviors($this->modelBehaviors);
        $model->trigger('afterView');
        return $this->controller->render($this->viewName, [
            'model' => $model
        ]);
    }
}

