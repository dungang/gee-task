<?php
namespace modules\sprint;

/**
 * 项目计划管理模块
 * @author dungang
 *
 */
class Module extends \yii\base\Module
{
    const CUSTOM_EVENT_STORY_CREATE = 'sprint.story.create';
    
    const CUSTOM_EVENT_STORY_CHANGE = 'sprint.story.change';
    
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

