<?php
namespace app\rules;

use yii\rbac\Rule;
use app\models\Project;

/**
 * 操作项目必须是自己创建的
 * @author dungang
 *
 */
class IsMyProject extends Rule
{

    public function execute($user, $item, $params)
    {
        if(Project::findOne(['id'=>$params['id'],'creator_id'=>$user])){
            return true;
        }
        return false;
    }
}

