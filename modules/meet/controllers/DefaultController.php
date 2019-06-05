<?php

namespace modules\meet\controllers;

use app\controllers\AppController;
use app\helpers\MiscHelper;


/**
 * DefaultController implements the CRUD actions for Meet model.
 */
class DefaultController extends AppController
{
	public function actions(){
	    $project_id = MiscHelper::getProjectId();
		return [
            'index' => [
                'class' => 'app\core\ListModelsAction',
                'modelClass' => [
                    'class' => 'modules\meet\models\MeetSearch',
                    'project_id'=>$project_id,
                ]
            ],
            'create' => [
                'class' => 'app\core\CreateModelAction',
                'modelClass' => [
                    'class' => 'modules\meet\models\Meet',
                    'project_id'=>$project_id,
                    'meet_date'=> date('Y-m-d')
                ]
            ],
            'update' => [
                'class' => 'app\core\UpdateModelAction',
                'modelClass' => [
                    'class' => 'modules\meet\models\Meet',
                    'project_id'=>$project_id,
                ]
            ],
            'view' => [
                'class' => 'app\core\ViewModelAction',
                'modelClass' => [
                    'class' => 'modules\meet\models\Meet',
                    'project_id'=>$project_id,
                ]
            ],
            'delete' => [
                'class' => 'app\core\DeleteModelAction',
                'modelClass' => [
                    'class' => 'modules\meet\models\Meet',
                    'project_id'=>$project_id,
                ]
            ],
		];
	}
}
