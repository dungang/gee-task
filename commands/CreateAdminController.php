<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use app\models\User;

/**
 * 创建管理员账号
 * @author dungang
 *
 */
class CreateAdminController extends Controller
{
    
    /**
     * 创建账号
     * @param string $username
     * @param string $password
     * @param string $email
     */
    public function actionIndex($username,$password,$email)
    {
        $user = new User();
        $user->username = $username;
        $user->generateAuthKey();
        $user->setPassword($password);
        $user->status = User::STATUS_ACTIVE;
        $user->email = $email;
        $user->is_admin = true;
        $user->is_super = true;
        if ($user->save())
        {
            echo "userName:" . $username . "\n";
            echo "password:" . $password . "\n";
            echo "      id:" . $user->id . "\n";
        } else {
            print_r($user->errors);
        }
        return ExitCode::OK;
    }
}
