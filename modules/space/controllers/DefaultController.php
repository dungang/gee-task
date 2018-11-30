<?php

namespace modules\space\controllers;

use app\controllers\AppController;
use app\helpers\MiscHelper;


/**
 * DefaultController implements the CRUD actions for Timeline model.
 */
class DefaultController extends AppController
{
	public function actions(){
	    $project_id = MiscHelper::getProjectId();
		return [
            'index' => [
                'class' => 'app\core\ListModelsAction',
                'modelClass' => [
                    'class' => 'modules\space\models\TimelineSearch',
                    'project_id'=> $project_id,
                ]
            ],
		    'create' => [
		        'class' => 'app\core\CreateModelAction',
		        'modelClass' => [
		            'class' => 'modules\space\models\Timeline',
		            'project_id'=> $project_id,
		        ]
		    ],
		    'update' => [
		        'class' => 'app\core\UpdateModelAction',
		        'modelClass' => [
		            'class' => 'modules\space\models\Timeline',
		            'project_id'=> $project_id,
		        ]
		    ],
            'delete' => [
                'class' => 'app\core\DeleteModelAction',
                'modelClass' => [
                    'class' => 'modules\space\models\Timeline',
                    'project_id'=> $project_id,
                ]
            ],
		];
	}
}
