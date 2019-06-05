<?php
namespace app\controllers;

use app\models\ProjectMember;
use app\models\Project;
use yii\web\BadRequestHttpException;
use app\models\User;
use app\helpers\MiscHelper;

class SwitchProjectController extends AdminController
{

    public function init(){
        $this->userActions = ['index'];
    }

    public function actionIndex($id)
    {
        $projectMem = ProjectMember::findOne([
            'project_id' => $id,
            'user_id' => \Yii::$app->user->id
        ]);
        if (null != $projectMem) {
            \Yii::$app->session->set(MiscHelper::SWITCH_PROJECT_ID, $id);
            $model = Project::findOne($id);
            //更新用户的默认控制台
            User::updateAll([
                'def_project' => $id
            ], [
                'id' => \Yii::$app->user->id
            ]);
            return $this->redirectOnSuccess([
                "/space",
                'id' => $model->id
            ], "成功切换到“" . $model->name . "”");
        }
        throw new BadRequestHttpException('The bad request!');
    }
}

