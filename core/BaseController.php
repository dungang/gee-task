<?php
namespace app\core;

use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\base\ActionEvent;
use yii\helpers\Url;
use yii\base\Event;

class BaseController extends Controller
{
    const EVENT_BEFORE_RENDER = 'beforeRend';

    /**
     * 游客可以访问的action清单
     *
     * @var array
     */
    public $guestActions = [];

    /**
     * 登录用户可以访问的action清单
     *
     * @var array
     */
    public $userActions = [];

    /**
     * 请求的方法过滤
     *
     * @var array
     */
    public $verbsActions = [];

    /**
     *
     * {@inheritdoc}
     */
    public function behaviors()
    {
        $defaultBehaviors = [];
        $defaultBehaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => $this->verbsActions
        ];
        return $defaultBehaviors;
    }

    public function beforeRender($params)
    {
        $event = new Event();
        $event->data = $params;
        $this->trigger(self::EVENT_BEFORE_RENDER, $event);
    }
    
    /**
     *
     * {@inheritdoc}
     * @see \yii\base\Controller::afterAction()
     */
    public function afterAction($action, $result)
    {
        $event = new ActionEvent($action);
        $event->result = $result;
        $this->trigger(self::EVENT_AFTER_ACTION, $event);
        if (is_array($result)) {
            if (isset($result['view']) && ! empty($result['view'])) {
                if (\Yii::$app->request->isAjax) {
                    $event->result = $this->renderAjax($result['view'], $result['data']);
                } else {
                    $event->result = $this->render($result['view'], $result['data']);
                }
            } else if (isset($result['redirectUrl']) && ! empty($result['redirectUrl'])) {
                $event->result = \Yii::$app->getResponse()->redirect(Url::to($result['redirectUrl']), $result['statusCode']);
            } else {
                unset($result['view']);
                unset($result['redirectUrl']);
                $event->result = $this->asJson($result);
            }
        }
        return $event->result;
    }

    private final function setFlash($status, $message)
    {
        if (! \Yii::$app->request->isAjax) {
            if ($status == 'success')
                \Yii::$app->session->setFlash("success", $message);
            else
                \Yii::$app->session->setFlash("error", $message);
        }
    }

    /**
     * 跳转
     *
     * @param string $status
     * @param string $url
     * @param number $statusCode
     * @param string $message
     * @return mixed|number[]|string[]
     */
    private final function thenRedirect($status, $url, $statusCode = 302, $message = '')
    {
        $this->setFlash($status, $message);
        return [
            'status' => $status,
            'redirectUrl' => $url,
            'statusCode' => $statusCode,
            'message' => $message
        ];
    }

    public final function redirectOnSuccess($url, $message = '处理成功')
    {
        return $this->thenRedirect('success', $url, 302, $message);
    }

    public final function redirectOnFail($url, $message = '处理失败')
    {
        return $this->thenRedirect('fail', $url, 302, $message);
    }

    public final function redirectOnException($url, $message = '处理异常')
    {
        return $this->thenRedirect('exception', $url, 302, $message);
    }

    public final function goHomeOnSuccess()
    {
        return $this->redirectOnSuccess(\Yii::$app->getHomeUrl(),'登录成功');
    }

    public final function goHomeOnFail()
    {
        return $this->redirectOnFail(\Yii::$app->getHomeUrl());
    }

    public final function gohomeOnException()
    {
        return $this->redirectOnException(\Yii::$app->getHomeUrl());
    }

    public final function goBackOnSuccess($defaultUrl = null)
    {
        return $this->redirectOnSuccess(\Yii::$app->getUser()
            ->getReturnUrl($defaultUrl));
    }

    public final function goBackOnFail($defaultUrl = null)
    {
        return $this->redirectOnFail(\Yii::$app->getUser()
            ->getReturnUrl($defaultUrl));
    }

    public final function goBackOnExcption($defaultUrl = null)
    {
        return $this->redirectOnException(\Yii::$app->getUser()
            ->getReturnUrl($defaultUrl));
    }

    public final function refreshOnSuccess($anchor = '')
    {
        return $this->redirectOnSuccess(\Yii::$app->getRequest()
            ->getUrl() . $anchor);
    }

    public final function refreshOnFail($anchor = '')
    {
        return $this->redirectOnFail(\Yii::$app->getRequest()
            ->getUrl() . $anchor);
    }

    public final function refreshOnExcepion($anchor = '')
    {
        return $this->redirectOnException(\Yii::$app->getRequest()
            ->getUrl() . $anchor);
    }

    /**
     * 返回
     *
     * @param string $status
     * @param string $view
     * @param array|object $params
     * @param string $message
     * @return array
     */
    private final function thenRender($status = 'success', $view = 'index', $params = [], $message = '')
    {
        $this->setFlash($status, $message);
        return [
            'status' => $status,
            'view' => $view,
            'message' => $message,
            'data' => $params
        ];
    }

    /**
     * 当成功的时候返回
     *
     * @param string $view
     * @param array $params
     * @return array
     */
    public final function renderOnSuccess($view, $params = [], $message = '处理成功')
    {
        return $this->thenRender('success', $view, $params, $message);
    }

    /**
     * 当成功的时候返回
     *
     * @param string $view
     * @param array $params
     * @return array
     */
    public final function renderWithoutViewOnSuccess($params = [], $message = '处理成功')
    {
        return $this->thenRender('success', null, $params, $message);
    }

    /**
     * 当失败的时候返回
     *
     * @param string $view
     * @param array $params
     * @return array
     */
    public final function renderOnFail($view, $params = [], $message = '处理失败')
    {
        return $this->thenRender('fail', $view, $params, $message);
    }

    /**
     * 当失败的时候返回
     *
     * @param string $view
     * @param array $params
     * @return array
     */
    public final function renderWithoutViewOnFail($params = [], $message = '处理失败')
    {
        return $this->thenRender('fail', null, $params, $message);
    }

    /**
     * 当异常的时候返回
     *
     * @param string $view
     * @param array $params
     * @return array
     */
    public final function renderOnException($view, $params = [], $message = '处理异常')
    {
        return $this->thenRender('exception', $view, $params, $message);
    }

    /**
     * 当异常的时候返回
     *
     * @param string $view
     * @param array $params
     * @return array
     */
    public final function renderwithoutViewOnException($params = [], $message = '处理异常')
    {
        return $this->thenRender('exception', null, $params, $message);
    }

    public function render($view, $params = [])
    {
        if (\Yii::$app->request->isAjax) {
            return parent::renderAjax($view, $params);
        }
        $this->beforeRender($params);
        return parent::render($view, $params);
    }
    
}

