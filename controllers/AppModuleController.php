<?php

namespace app\controllers;

/**
 * AppModuleController implements the CRUD actions for AppModule model.
 */
class AppModuleController extends AdminController
{
    public function actions(){
        return [
            'index' => [
                'class' => 'app\core\ListModelsAction',
                'modelClass' => [
                    'class' => 'app\models\AppModuleSearch'
                ]
            ],
            'create' => [
                'class' => 'app\core\CreateModelAction',
                'modelClass' => [
                    'class' => 'app\models\AppModule'
                ]
            ],
            'update' => [
                'class' => 'app\core\UpdateModelAction',
                'modelClass' => [
                    'class' => 'app\models\AppModule'
                ]
            ],
            'view' => [
                'class' => 'app\core\ViewModelAction',
                'modelClass' => [
                    'class' => 'app\models\AppModule'
                ]
            ],
            'delete' => [
                'class' => 'app\core\DeleteModelAction',
                'modelClass' => [
                    'class' => 'app\models\AppModule'
                ]
            ],
        ];
    }
}
