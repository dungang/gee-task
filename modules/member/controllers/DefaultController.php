<?php

namespace modules\member\controllers;

use app\controllers\AppController;
use app\helpers\MiscHelper;


/**
 * DefaultController implements the CRUD actions for ProjectMember model.
 */
class DefaultController extends AppController
{
	public function actions(){
	    $project_id = MiscHelper::getProjectId();
		return [
            'index' => [
                'class' => 'app\core\ListModelsAction',
                'modelClass' => [
                    'class' => 'modules\member\models\ProjectMemberSearch',
                    'project_id'=>$project_id,
                ]
            ],
            'create' => [
                'class' => 'app\core\CreateModelAction',
                'modelClass' => [
                    'class' => 'app\models\ProjectMember',
                    'project_id'=>$project_id,
                ]
            ],
            'update' => [
                'class' => 'app\core\UpdateModelAction',
                'modelClass' => [
                    'class' => 'app\models\ProjectMember',
                    'project_id'=>$project_id,
                ]
            ],
            'view' => [
                'class' => 'app\core\ViewModelAction',
                'modelClass' => [
                    'class' => 'app\models\ProjectMember',
                    'project_id'=>$project_id,
                ]
            ],
            'delete' => [
                'class' => 'app\core\DeleteModelAction',
                'modelClass' => [
                    'class' => 'app\models\ProjectMember'
                ]
            ],
		];
	}
	
	public function actionUpdate($user_id) {
	    
	}
}
