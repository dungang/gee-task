<?php
namespace app\filters;

use yii\base\ActionFilter;
use app\controllers\AppController;
use app\helpers\MiscHelper;

/**
 * 用户多项目的情况默认查询可以切换的项目，
 * 并保存在会话中，避免重复查询
 * 如果是 \app\controllers\AppController，则设置控制的属性project_id
 * @author dungang
 * 
 * @property \app\controllers\AppController $owner
 *
 */
class SwitchProjectFilter extends ActionFilter
{

    const FILTER_SWITCH_PROJECT = 'switch-project-filter';

    /**
     *
     * @param \yii\base\Action $action
     *            the action to be executed.
     * @return bool whether the action should continue to be executed.
     */
    public function beforeAction($action)
    {
       $project_id = MiscHelper::initUserDefultProject();
        //如果控制器是\app\controllers\AppController，则设置属性project_id
        if($this->owner instanceof AppController)
            $this->owner->project_id = $project_id;
        
        return true;
    }
}

