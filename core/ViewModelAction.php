<?php
namespace app\core;

class ViewModelAction extends BaseAction
{
    public function run() {
        return $this->controller->render($this->id, [
            'model' => $this->findModel(),
        ]);
    }
}

