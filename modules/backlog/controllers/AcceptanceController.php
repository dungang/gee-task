<?php

namespace modules\backlog\controllers;

use app\controllers\AppController;
use app\helpers\MiscHelper;


/**
 * AcceptanceController implements the CRUD actions for StoryAcceptance model.
 */
class AcceptanceController extends AppController
{
    public function actions(){
        $project_id = MiscHelper::getProjectId();
		return [
            'index' => [
                'class' => 'app\core\ListModelsAction',
                'modelClass' => [
                    'class' => 'modules\sprint\models\StoryAcceptanceSearch',
                    'project_id'=>$project_id,
                ]
            ],
            'create' => [
                'class' => 'app\core\CreateModelAction',
                'modelClass' => [
                    'class' => 'modules\sprint\models\StoryAcceptance',
                    'project_id'=>$project_id,
                ]
            ],
            'update' => [
                'class' => 'app\core\UpdateModelAction',
                'modelClass' => [
                    'class' => 'modules\sprint\models\StoryAcceptance',
                    'project_id'=>$project_id,
                ]
            ],
            'view' => [
                'class' => 'app\core\ViewModelAction',
                'modelClass' => [
                    'class' => 'modules\sprint\models\StoryAcceptance',
                    'project_id'=>$project_id,
                ]
            ],
            'delete' => [
                'class' => 'app\core\DeleteModelAction',
                'modelClass' => [
                    'class' => 'modules\sprint\models\StoryAcceptance',
                    'project_id'=>$project_id,
                ]
            ],
		];
	}
}
