<?php
namespace app\core;

use yii\rbac\DbManager;
use app\helpers\MiscHelper;
use yii\rbac\Assignment;

class CoreAuthManager extends DbManager
{
    /**
     * {@inheritDoc}
     * @see \yii\rbac\DbManager::getAssignments()
     */
    public function getAssignments($userId)
    {
        $assignments = parent::getAssignments($userId);
        if(($project = $project = MiscHelper::getProject()) && isset($project['position'])){
            $assignments[$project['position']] = new Assignment([
                'userId' => $userId,
                'roleName' => $project['position']
            ]);
        }
        return $assignments;
    }
}

