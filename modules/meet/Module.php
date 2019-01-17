<?php
namespace modules\meet;

/**
 * 项目会议记录模块
 * @author dungang
 *
 */
class Module extends \yii\base\Module
{
    const CUSTOM_EVENT_MEETING_SAVE = 'meeting.save';
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'modules\meet\controllers';
    
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        
    }
}

