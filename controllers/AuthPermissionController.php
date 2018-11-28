<?php
namespace app\controllers;


/**
 * AuthPermissionController implements the CRUD actions for AuthPermission model.
 */
class AuthPermissionController extends AdminController
{

    public function actions(){
        return [
            'index' => [
                'class' => 'app\core\ListModelsAction',
                'modelClass' => [
                    'class' => 'app\models\AuthPermissionSearch'
                ]
            ],
            'create' => [
                'class' => 'app\core\CreateModelAction',
                'modelClass' => [
                    'class' => 'app\models\AuthPermission'
                ]
            ],
            'update' => [
                'class' => 'app\core\UpdateModelAction',
                'modelClass' => [
                    'class' => 'app\models\AuthPermission'
                ]
            ],
            'view' => [
                'class' => 'app\core\ViewModelAction',
                'modelClass' => [
                    'class' => 'app\models\AuthPermission'
                ]
            ],
            'delete' => [
                'class' => 'app\core\DeleteModelAction',
                'modelClass' => [
                    'class' => 'app\models\AuthPermission'
                ]
            ],
        ];
    }

}
