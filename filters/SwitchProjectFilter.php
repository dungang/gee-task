<?php
namespace app\filters;

use yii\base\ActionFilter;
use app\models\Project;
use app\controllers\AppController;
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
    const SWITCH_PROJECT_ID = '_project_id';
    const SWITCH_PROJECTS = '_joined_projects';

    /**
     *
     * @param \yii\base\Action $action
     *            the action to be executed.
     * @return bool whether the action should continue to be executed.
     */
    public function beforeAction($action)
    {
        $session = \Yii::$app->session;
        $project_id = $session->get(self::SWITCH_PROJECT_ID);
        $projects = $session->get(self::SWITCH_PROJECTS);
        //如果session中没有存储用户参与的项目
        if( $projects== null) {
            $projects = $this->loadUserJoinedProjects();
            $session->set(self::SWITCH_PROJECTS,$projects);
        }
        //如果当前的会话项目id为空 或者 默认的项目id不存在会员参与的项目中
        //默认读取第一个作为会话项目
        if($project_id == null || isset($projects[$project_id])==false) {
            $project_id =  array_shift(array_keys($projects));
            $session->set(self::SWITCH_PROJECT_ID,$project_id);
        }
        
        //如果控制器是\app\controllers\AppController，则设置属性project_id
        if($this->owner instanceof AppController)
            $this->owner->project_id = $project_id;
        
        return true;
    }

    /**
     * 加载用户的项目
     * id:ProjectId
     * name: ProjectName
     * position: user position In project
     */
    protected function loadUserJoinedProjects()
    {
        $q = Project::loadJoinedProjectsQuery('id,name,position');
        return $q->indexBy('id')->all();
    }
}

