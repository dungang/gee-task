<?php
namespace app\core;

use yii\base\Action;
use yii\web\NotFoundHttpException;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\db\ActiveRecord;

/**
 *
 * @author dungang
 * @property BaseController $controller 控制器
 */
class BaseAction extends Action
{

    const EVENT_BEFORE_RUN = 'actionBeforeRun';

    const EVENT_AFTER_RUN = 'actionAfterRun';

    /**
     * view 文件的名称
     *
     * @var string
     */
    public $viewName;

    /**
     * action的行为
     *
     * @var string
     */
    public $actionBehaviors = [];

    /**
     * 模型的行为
     *
     * @var array
     */
    public $modelBehaviors = [];

    /**
     * 模型配置参数
     * \Yii::createObject 的参数
     * ['class'=>'className','prop'=>'val']
     *
     * @var array|string
     */
    public $modelClass = null;

    /**
     * 条件查找参数
     *
     * @var array|null
     */
    public $findParams = null;

    /**
     * 固定赋值参数
     *
     * @var null|array
     */
    public $assignParams = null;

    /**
     * 成功操作的跳转地址，如果没有设置，则使用默认的
     *
     * @var string
     */
    public $successRediretUrl = false;

    public $successMsg = '添加成功';

    /**
     * 设置固定的参数，避免被外部覆盖
     *
     * @param Model $model
     * @return boolean
     */
    protected function setAssignParams($model)
    {
        if ($this->assignParams) {
            foreach ($this->assignParams as $field => $val) {
                $model->{$field} = $val;
            }
        }
        return true;
    }

    /**
     * 获取get参数
     *
     * @param Model $model
     */
    protected function composeGetParams($model)
    {
        $params = \Yii::$app->request->queryParams;
        if ($this->findParams) {
            $formName = $model->formName();
            if (empty($params[$formName]))
                $params[$formName] = [];
            $params[$formName] = \array_merge($params[$formName], $this->findParams);
        }
        return $params;
    }

    /**
     * 获取post参数
     *
     * @param Model $model
     * @param bool $multiple
     *            是否多模型
     */
    protected function composePostParams($model, $multiple = false)
    {
        $params = \Yii::$app->request->post();
        if ($this->assignParams) {
            $formName = $model->formName();
            if (empty($params[$formName]))
                $params[$formName] = [];
            if ($multiple === false) {
                $params[$formName] = \array_merge($params[$formName], $this->assignParams);
            } else {
                foreach ($params[$formName] as $i => $param) {
                    $params[$formName][$i] = \array_merge($param, $this->assignParams);
                }
            }
        }
        return $params;
    }

    /**
     *
     * {@inheritdoc}
     * @see \yii\base\Action::afterRun()
     */
    protected function afterRun()
    {
        $this->trigger(self::EVENT_AFTER_RUN);
    }

    /**
     *
     * {@inheritdoc}
     * @see \yii\base\Action::beforeRun()
     */
    protected function beforeRun()
    {
        $this->trigger(self::EVENT_BEFORE_RUN);
        return parent::beforeRun();
    }

    public function init()
    {
        if (empty($this->viewName)) {
            $this->viewName = $this->id;
        }
        if (! empty($this->actionBehaviors)) {
            $this->attachBehaviors($this->actionBehaviors);
        }
    }

    /**
     * 计算跳转的参数或url
     *
     * @param BaseModel $model
     * @return mixed[]|string
     */
    protected function getSuccessRediretUrlWidthModel($model)
    {
        if (is_array($this->successRediretUrl)) {
            $url = [];
            $url[] = \array_shift($this->successRediretUrl);
            foreach ($this->successRediretUrl as $p => $f) {
                $url[$p] = $model[$f];
            }
            return $url;
        }
        return $this->successRediretUrl;
    }

    /**
     * 获取模型的主键，并自动装配了关系数组
     *
     * @param \yii\db\ActiveRecordInterface $class
     * @throws InvalidConfigException
     * @return mixed|bool
     */
    protected function getPrimaryKeyCondition($class)
    {
        // query by primary key
        if (method_exists($class, 'primaryKey')) {
            $primaryKey = $class::primaryKey();
            $cond = [];
            foreach ($primaryKey as $key) {
                $cond[$key] = \Yii::$app->request->get($key);
            }
            return $cond;
        }
        return null;
    }

    /**
     * 查找一个模型对象实例
     *
     * @param boolean $createOneOnNotFound
     * @throws NotFoundHttpException
     * @return mixed|object|ActiveRecord
     */
    protected function findModel($createOneOnNotFound = false)
    {
        /* @var $model ActiveRecord */
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
            if (isset($args['scenario'])) {
                $scenario = $args['scenario'];
                unset($args['scenario']);
            }
            if ($class) {

                $condition = array_merge($this->getPrimaryKeyCondition($class), $args);

                //是否设置了查找的固定参数
                if ($this->findParams) {
                    $condition = \array_merge($condition, $this->findParams);
                }

                $model = call_user_func(array(
                    $class,
                    'findOne'
                ), $this->clearCond($condition));
            }
        }
        if ($model !== null) {
            $model->setScenario($scenario);
            return $model;
        } else if ($createOneOnNotFound) {
            return \Yii::createObject([
                'class' => $this->modelClass,
                'scenario' => $scenario
            ]);
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * 根据多个id查找，目前该方法还不完善
     *
     * @param array $ids
     * @throws NotFoundHttpException
     * @return mixed
     */
    protected function findModels($ids)
    {
        $models = null;
        if ($this->modelClass) {
            $class = $this->modelClass;
            if (is_array($this->modelClass) && isset($this->modelClass['class'])) {
                $class = $this->modelClass['class'];
            }
            $cond = [
                'id' => $ids
            ];

            //是否设置了查找的固定参数
            if ($this->findParams) {
                $cond = $this->clearCond($cond, $this->findParams);
            }
            $models = call_user_func(array(
                $class,
                'findAll'
            ), \array_filter($cond));
        }
        if ($models !== null) {
            return $models;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function clearCond($cond)
    {
        return \array_filter($cond, function ($val) {
            return ! \is_null($val);
        });
    }
}

