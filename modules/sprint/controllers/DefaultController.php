<?php

namespace modules\sprint\controllers;

use app\controllers\AppController;


/**
 * DefaultController implements the CRUD actions for Sprint model.
 */
class DefaultController extends AppController
{
	public function actions(){
		return [
            'index' => [
                'class' => 'app\core\ListModelsAction',
                'modelClass' => [
                    'class' => 'modules\sprint\models\SprintSearch'
                ]
            ],
            'create' => [
                'class' => 'app\core\CreateModelAction',
                'modelClass' => [
                    'class' => 'modules\sprint\models\Sprint'
                ]
            ],
            'update' => [
                'class' => 'app\core\UpdateModelAction',
                'modelClass' => [
                    'class' => 'modules\sprint\models\Sprint'
                ]
            ],
            'view' => [
                'class' => 'app\core\ViewModelAction',
                'modelClass' => [
                    'class' => 'modules\sprint\models\Sprint'
                ]
            ],
            'delete' => [
                'class' => 'app\core\DeleteModelAction',
                'modelClass' => [
                    'class' => 'modules\sprint\models\Sprint'
                ]
            ],
		];
	}
}
