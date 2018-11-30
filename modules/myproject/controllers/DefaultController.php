<?php

namespace modules\myproject\controllers;

use app\controllers\AppController;


/**
 * DefaultController implements the CRUD actions for Project model.
 */
class DefaultController extends AppController
{
	public function actions(){
	    $user_id = \Yii::$app->user->id;
		return [
            'index' => [
                'class' => 'app\core\ListModelsAction',
                'modelClass' => [
                    'class' => 'modules\myproject\models\ProjectSearch',
                    'creator_id'=>$user_id,
                ]
            ],
            'create' => [
                'class' => 'app\core\CreateModelAction',
                'modelClass' => [
                    'class' => 'app\models\Project',
                    'creator_id'=>$user_id,
                ]
            ],
            'update' => [
                'class' => 'app\core\UpdateModelAction',
                'modelClass' => [
                    'class' => 'app\models\Project',
                    'creator_id'=>$user_id,
                ]
            ],
            'view' => [
                'class' => 'app\core\ViewModelAction',
                'modelClass' => [
                    'class' => 'app\models\Project',
                    'creator_id'=>$user_id,
                ]
            ],
            'delete' => [
                'class' => 'app\core\DeleteModelAction',
                'modelClass' => [
                    'class' => 'app\models\Project',
                    'creator_id'=>$user_id,
                ]
            ],
		];
	}
}
