<?php

namespace modules\robot\controllers;

use app\controllers\AppController;
use app\helpers\MiscHelper;


/**
 * DefaultController implements the CRUD actions for ProjectRobot model.
 */
class DefaultController extends AppController
{
    public function actions(){
        $project_id = MiscHelper::getProjectId();
		return [
            'index' => [
                'class' => 'app\core\ListModelsAction',
                'modelClass' => [
                    'class' => 'modules\robot\models\ProjectRobotSearch',
                    'project_id'=>$project_id,
                ]
            ],
            'create' => [
                'class' => 'app\core\CreateModelAction',
                'modelClass' => [
                    'class' => 'modules\robot\models\ProjectRobot',
                    'project_id'=>$project_id,
                ]
            ],
            'update' => [
                'class' => 'app\core\UpdateModelAction',
                'modelClass' => [
                    'class' => 'modules\robot\models\ProjectRobot',
                    'project_id'=>$project_id,
                ]
            ],
            'view' => [
                'class' => 'app\core\ViewModelAction',
                'modelClass' => [
                    'class' => 'modules\robot\models\ProjectRobot',
                    'project_id'=>$project_id,
                ]
            ],
            'delete' => [
                'class' => 'app\core\DeleteModelAction',
                'modelClass' => [
                    'class' => 'modules\robot\models\ProjectRobot',
                    'project_id'=>$project_id,
                ]
            ],
		];
	}
}
