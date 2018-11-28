<?php
namespace app\controllers;

use app\models\ProjectMember;
use app\filters\SwitchProjectFilter;
use app\models\Project;
use yii\web\BadRequestHttpException;

class SwtichProjectController extends AdminController
{
    public function actionIndex($id)
    {
        $orgMem = ProjectMember::findOne([
            'project_id' => $id,
            'user_id' => \Yii::$app->user->id
        ]);
        if (null != $orgMem) {
            \Yii::$app->session->set(SwitchProjectFilter::SWITCH_PROJECT_ID, $id);
            $model = Project::findOne($id);
            return $this->redirectOnSuccess([
                "/org/space",
                'id' => $model->id
            ], "成功切换到“" . $model->name . "”");
        }
        throw new BadRequestHttpException('The bad request!');
    }
    
}

