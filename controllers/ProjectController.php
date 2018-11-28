<?php

namespace app\controllers;


/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends AdminController
{
	public function actions(){
	    $userId = \Yii::$app->user->id;
		return [
            'all' => [
                'class' => 'app\core\ListModelsAction',
                'modelClass' => [
                    'class' => 'app\models\ProjectSearch'
                ]
            ],
		    'index' => [
		        'class' => 'app\core\ListModelsAction',
		        'modelClass' => [
		            'class' => 'app\models\ProjectSearch',
		            'creator_id'=>$userId,
		        ]
		    ],
            'create' => [
                'class' => 'app\core\CreateModelAction',
                'modelClass' => [
                    'class' => 'app\models\Project',
		            'creator_id'=>$userId,
                ]
            ],
            'update' => [
                'class' => 'app\core\UpdateModelAction',
                'modelClass' => [
                    'class' => 'app\models\Project',
                ]
            ],
            'view' => [
                'class' => 'app\core\ViewModelAction',
                'modelClass' => [
                    'class' => 'app\models\Project'
                ]
            ],
            'delete' => [
                'class' => 'app\core\DeleteModelAction',
                'modelClass' => [
                    'class' => 'app\models\Project'
                ]
            ],
		];
	}
	
}
