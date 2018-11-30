<?php
namespace app\filters;

use app\models\AcRoute;
use yii\base\Behavior;
use yii\web\Controller;
use app\models\AppModule;
use app\models\AuthPermission;
use app\models\AuthItemChild;

/**
 * 自動記錄請求的route
 * 开发阶段生效
 * 生产环境不会启用
 * 主要是帮助开发者自动填充基础的权限，模块，路由等关联的关系，
 * 避免手工录入遗漏
 *
 * @author dungang
 *        
 */
class SaveRouteFilter extends Behavior
{

    /**
     *
     * {@inheritdoc}
     */
    public function attach($owner)
    {
        $this->owner = $owner;
        $owner->on(Controller::EVENT_BEFORE_ACTION, [
            $this,
            'saveAction'
        ]);
    }

    /**
     *
     * @param \yii\base\ActionEvent $event
     */
    public function saveAction($event)
    {
        /* @var \app\controllers\AdminController $controller  */
        $controller = $this->owner;
        $action = $event->action;
        
        // 添加模块
        $module = str_replace("/", "-", $controller->uniqueId);
        $moduleObj = AppModule::findOne([
            'name' => $module,
            'type' => AppModule::TYPE_MODULE
        ]);
        
        if ($moduleObj === null) {
            $moduleObj = new AppModule();
            $moduleObj->name = $module;
            $moduleObj->description = str_replace("-", " ", $module);
            $moduleObj->save(FALSE);
        }
        
        // 添加路由+权限(permission)
        $route = '/' . $event->action->uniqueId;
        $permission = trim(str_replace("/", "-", $route),"-");
        $description = str_replace("-", " ", $permission);
        
        if (! in_array($action->id, $controller->guestActions) && ! in_array($action->id, $controller->userActions)) {
            
            // 添加路由
            $routeObj = AcRoute::findOne([
                'name' => $route,
                'type' => AcRoute::TYPE_ROUTE
            ]);
            
            if ($routeObj === null) {
                $routeObj = new AcRoute();
                $routeObj->name = $route;
                $routeObj->description = $description;
                $routeObj->save(FALSE);
            }
            
            // 添加权限
            $permissionObj = AuthPermission::findOne([
                'name' => $permission,
                'type' => AuthPermission::TYPE_PERMISSION
            ]);
            
            if ($permissionObj === null) {
                $permissionObj = new AuthPermission();
                $permissionObj->name = $permission;
                $permissionObj->description = $description;
                $permissionObj->save(FALSE);
            }
            
            // 添加所属关系 route 所属 module
            $routeRelation = AuthItemChild::findOne(['parent'=>$module,'child'=>$route]);
            if ($routeRelation === null) {
                $routeRelation = new AuthItemChild();
                $routeRelation->parent = $module;
                $routeRelation->child = $route;
                $routeRelation->save(FALSE);
            }
            
            // 添加所属关系 permission 所属 module
            $permRelation = AuthItemChild::findOne(['parent'=>$module,'child'=>$permission]);
            if ($permRelation === null) {
                $permRelation = new AuthItemChild();
                $permRelation->parent = $module;
                $permRelation->child = $permission;
                $permRelation->save(FALSE);
            }
            
            // 添加所属关系 route 所属 默认的权限
            $routeRelation = AuthItemChild::findOne(['parent'=>$permission,'child'=>$route]);
            if ($routeRelation === null) {
                $routeRelation = new AuthItemChild();
                $routeRelation->parent = $permission;
                $routeRelation->child = $route;
                $routeRelation->save(FALSE);
            }
            
        }
        
        
        return true;
    }
}

