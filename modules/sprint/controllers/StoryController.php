<?php
namespace modules\sprint\controllers;

use app\controllers\AppController;
use app\helpers\MiscHelper;

/**
 * StoryController implements the CRUD actions for Story model.
 */
class StoryController extends AppController
{

    public function actions()
    {
        $project_id = MiscHelper::getProjectId();
        return [
            'index' => [
                'class' => 'app\core\ListModelsAction',
                'modelClass' => [
                    'class' => 'modules\sprint\models\StorySearch',
                    'project_id' => $project_id
                ]
            ],
            'create' => [
                'class' => 'app\core\CreateModelAction',
                'modelClass' => [
                    'class' => 'modules\sprint\models\Story',
                    'project_id' => $project_id,
                ]
            ],
            'update' => [
                'class' => 'app\core\UpdateModelAction',
                'modelClass' => [
                    'class' => 'modules\sprint\models\Story',
                    'project_id' => $project_id,
                ]
            ],
            'trans' => [
                'class' => 'app\core\UpdateModelAction',
                'modelClass' => [
                    'class' => 'modules\sprint\models\Story',
                    'project_id' => $project_id,
                ]
            ],
            'view' => [
                'class' => 'app\core\ViewModelAction',
                'modelClass' => [
                    'class' => 'modules\sprint\models\Story',
                    'project_id' => $project_id,
                ]
            ],
            'delete' => [
                'class' => 'app\core\DeleteModelAction',
                'modelClass' => [
                    'class' => 'modules\sprint\models\Story',
                    'project_id' => $project_id,
                ]
            ]
        ];
    }
}
