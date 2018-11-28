<?php
namespace app\core;

class ViewModelAction extends BaseAction
{
    public function run($id) {
        return $this->controller->render($this->id, [
            'model' => $this->findModel($id),
        ]);
    }
}

