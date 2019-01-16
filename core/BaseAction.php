<?php
namespace app\core;

use yii\base\Action;
use yii\web\NotFoundHttpException;
use yii\base\InvalidConfigException;
use yii\base\Model;

/**
 * 
 * @author dungang
 * 
 * @property BaseController $controller 控制器
 */
class BaseAction extends Action
{
    const EVENT_BEFORE_RUN = 'beforeRun';
    const CREATE_ONE_ON_NOT_FOUND_YES = true;
    const CREATE_ONE_ON_NOT_FOUND_NO = false;
    
    public $defaultView = null;
    
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
    
    public function init(){
        if(\is_null($this->defaultView)) {
            $this->defaultView = $this->id;
        }
    }
    
    
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


    protected function findModel($createOneOnNotFound=false)
    {
        $model = null;
        $scenario = Model::SCENARIO_DEFAULT;
        if ($this->modelClass) {
            if (is_string($this->modelClass)) {
                $class = $this->modelClass;
                $args = [];
            } else if (is_array($this->modelClass) && isset($this->modelClass['class'])) {
                $args = $this->modelClass;
                $class = array_shift($args);
            }
            if(isset($args['scenario'])) {
                $scenario = $args['scenario'];
                unset($args['scenario']);
            }
            if($class) {
                
                $condition = array_merge($this->getPrimaryKeyCondition($class), $args);
                $model = call_user_func(array(
                    $class,
                    'findOne'
                ), $condition);
            }
        }
        if ($model !== null) {
            $model->scenario = $scenario;
            return $model;
        } else  if($createOneOnNotFound) {
            return \Yii::createObject($this->modelClass,['scenario'=>$scenario]);
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

