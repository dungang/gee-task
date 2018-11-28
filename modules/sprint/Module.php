<?php
namespace modules\sprint;

/**
 * 项目计划管理模块
 * @author dungang
 *
 */
class Module extends \yii\base\Module
{
    const EVENT_ASSIGN_TASK = 'sprint.assign.task';
    
    const EVENT_ADD_STORY_ACTIVE = 'sprint.add.story.active';
    
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'modules\sprint\controllers';
    
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        
    }
    
}

