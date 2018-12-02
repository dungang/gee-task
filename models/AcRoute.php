<?php
namespace app\models;

use yii\db\Query;
use yii\rbac\Assignment;
use app\helpers\MiscHelper;

/**
 * 是否可以路由。
 * 多个路由可以分配到指定的权限之下，目的是控制路由的权限
 *
 * 分2中情况：
 * 1.前端用户，前端用户根据在项目中的职位决定权限。
 * 2.后台管理员（有超级管理员和普通管理员）根据用户分配的角色决定权限
 *
 * @author dungang
 *        
 */
class AcRoute extends AuthItem
{

    public function init()
    {
        // 类型默认为路由
        $this->type = parent::TYPE_ROUTE;
    }

    /**
     * 后台管理员（有超级管理员和普通管理员）根据用户分配的角色决定权限
     *
     * @param string $route
     * @param array $param
     *            参数（$GET or $POST）传递给规则使用的
     * @return boolean
     */
    public static function canRoute($route, $param = [])
    {
        $permission = (new Query())->from(AuthItem::tableName())
            ->leftjoin(AuthItemChild::tableName(), AuthItem::tableName() . '.name = ' . AuthItemChild::tableName() . '.parent')
            ->where([
            AuthItemChild::tableName() . '.child' => $route,
            AuthItem::tableName() . '.type' => AuthItem::TYPE_PERMISSION
        ])
            ->one();

        if ($permission) {
            return \Yii::$app->user->can($permission['name'], $param);
        } else {
            return false;
        }
    }
}

