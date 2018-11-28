<?php

namespace modules\sprint\controllers;

use app\controllers\AppController;


/**
 * StoryActiveController implements the CRUD actions for StoryActive model.
 */
class StoryActiveController extends AppController
{
	public function actions(){
		return [
            'index' => [
                'class' => 'app\core\ListModelsAction',
                'modelClass' => [
                    'class' => 'modules\sprint\models\StoryActiveSearch'
                ]
            ],
            'create' => [
                'class' => 'app\core\CreateModelAction',
                'modelClass' => [
                    'class' => 'modules\sprint\models\StoryActive'
                ]
            ],
            'update' => [
                'class' => 'app\core\UpdateModelAction',
                'modelClass' => [
                    'class' => 'modules\sprint\models\StoryActive'
                ]
            ],
            'view' => [
                'class' => 'app\core\ViewModelAction',
                'modelClass' => [
                    'class' => 'modules\sprint\models\StoryActive'
                ]
            ],
            'delete' => [
                'class' => 'app\core\DeleteModelAction',
                'modelClass' => [
                    'class' => 'modules\sprint\models\StoryActive'
                ]
            ],
		];
	}
}
