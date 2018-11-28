<?php

namespace app\controllers;

use app\helpers\MiscHelper;
use app\models\Project;
use yii\web\NotFoundHttpException;

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
	
	/**
	 * 控制台
	 *
	 * @param null|int $id
	 * @return string
	 */
	public function actionSpace($id = null)
	{
	    if ($id == null) {
	        $id = MiscHelper::getProjectId();
	    }
	    if ($id == null) {
	        return $this->redirect(['/project/index']);
	    }
	    
	    return $this->render('space', [
	        'model' => $this->findModel($id)
	    ]);
	}
	
	protected function findModel($condition)
	{
	    if ($org = Project::findOne($condition)) {
	        return $org;
	    }
	    throw new NotFoundHttpException('The requested page does not exist.');
	}
	
}
