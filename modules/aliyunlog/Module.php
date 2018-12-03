<?php
namespace modules\aliyunlog;
require __DIR__ . '/aliyun-log-sdk/Log_Autoload.php';
/**
 * 阿里云日志
 * @author dungang
 *
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'modules\aliyunlog\controllers';
    
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        
    }
}

