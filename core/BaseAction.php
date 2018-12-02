<?php
namespace app\core;

use yii\base\Action;
use yii\web\NotFoundHttpException;
use yii\base\InvalidConfigException;

/**
 * 
 * @author dungang
 * 
 * @property BaseController $controller 控制器
 */
class BaseAction extends Action
{
    const EVENT_BEFORE_RUN = 'beforeRun';
    
    public $modelBehaviors = [];
    
    /**
     * \Yii::createObject 的参数
     * ['class'=>'className','prop'=>'val']
     *
     * @var array|string
     */
    public $modelClass = null;
    
    /**
     * 必须传递的参数名称
     * @var null|array
     */
    public $mustArgs = null;
    
    /**
     * 成功操作的跳转地址，如果没有是设置使用默认的
     * @var string
     */
    public $successRediretUrl = false;
    
    
    /**
     * 
     * @param \yii\db\ActiveRecordInterface $class
     * @throws InvalidConfigException
     * @return mixed|bool
     */
    protected function getPrimaryKeyCondition($class){
        // query by primary key
        if(method_exists($class, 'primaryKey')) {
            $primaryKey = $class::primaryKey();
            $cond = [];
            foreach($primaryKey as $key) {
                $cond[$key] = \Yii::$app->request->get($key);
            }
            return $cond;
        }
        return null;
    }


    protected function findModel()
    {
        $model = null;
        if ($this->modelClass) {
            if (is_string($this->modelClass)) {
                $class = $this->modelClass;
                $args = [];
            } else if (is_array($this->modelClass) && isset($this->modelClass['class'])) {
                $args = $this->modelClass;
                $class = array_shift($args);
            }
            if($class) {
                
                $condition = $this->getPrimaryKeyCondition($class) + $args;
                $model = call_user_func(array(
                    $class,
                    'findOne'
                ), $condition);
            }
        }
        if ($model !== null) {
            return $model;
        }
        
        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    protected function findModels($ids)
    {
        $models = null;
        if ($this->modelClass) {
            if (is_string($this->modelClass)) {
                $models = call_user_func(array(
                    $this->modelClass,
                    'findAll'
                ), $ids);
            } else if (is_array($this->modelClass) && isset($this->modelClass['class'])) {
                $models = call_user_func(array(
                    $this->modelClass['class'],
                    'findAll'
                ), $ids);
            }
        }
        if ($models !== null) {
            return $models;
        }
        
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

