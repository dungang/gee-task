<?php
namespace app\controllers;

use Yii;
use app\forms\LoginForm;
use app\helpers\MiscHelper;

/**
 * Site controller
 */
class SiteController extends AdminController
{

    public function init()
    {
        $this->guestActions = [
            'login',
            'error',
            'about',
        ];
        $this->userActions = [
            'logout',
            'index'
        ];
        $this->verbsActions = [
            'logout' => [
                'post'
            ]
        ];
    }

    /**
     *
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'layout'=>'error'
            ]
        ];
    }
    

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    protected function switchToDefaultProject(){
        if($projectId = MiscHelper::getProjectId()) {
            return $this->redirect(['/switch-project/index',
                'id'=>$projectId
            ]);
        }
        return false;
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (! Yii::$app->user->isGuest) {
            if($resp = $this->switchToDefaultProject()){
                return $resp;
            }
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            MiscHelper::initUserDefultProject();
            if($resp = $this->switchToDefaultProject()){
                return $resp;
            }
            return $this->goHomeOnSuccess();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
