<?php

namespace app\controllers;


/**
 * AcRouteController implements the CRUD actions for AcRoute model.
 */
class AcRouteController extends AdminController
{
    public function actions(){
        return [
            'index' => [
                'class' => 'app\core\ListModelsAction',
                'modelClass' => [
                    'class' => 'app\models\AcRouteSearch'
                ]
            ],
            'create' => [
                'class' => 'app\core\CreateModelAction',
                'modelClass' => [
                    'class' => 'app\models\AcRoute'
                ]
            ],
            'update' => [
                'class' => 'app\core\UpdateModelAction',
                'modelClass' => [
                    'class' => 'app\models\AcRoute'
                ]
            ],
            'view' => [
                'class' => 'app\core\ViewModelAction',
                'modelClass' => [
                    'class' => 'app\models\AcRoute'
                ]
            ],
            'delete' => [
                'class' => 'app\core\DeleteModelAction',
                'modelClass' => [
                    'class' => 'app\models\AcRoute'
                ]
            ],
        ];
    }
  
}
