<?php

namespace app\controllers;

use app\models\AuthItemChild;
use yii\data\ActiveDataProvider;
use app\models\AuthItem;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use app\models\AuthRole;


/**
 * RoleController implements the CRUD actions for Role model.
 */
class AuthRoleController extends AdminController
{
	public function actions(){
		return [
            'index' => [
                'class' => 'app\core\ListModelsAction',
                'modelClass' => [
                    'class' => 'app\models\RoleSearch'
                ]
            ],
            'create' => [
                'class' => 'app\core\CreateModelAction',
                'modelClass' => [
                    'class' => 'app\models\Role'
                ]
            ],
            'update' => [
                'class' => 'app\core\UpdateModelAction',
                'modelClass' => [
                    'class' => 'app\models\Role'
                ]
            ],
            'view' => [
                'class' => 'app\core\ViewModelAction',
                'modelClass' => [
                    'class' => 'app\models\Role'
                ]
            ],
            'delete' => [
                'class' => 'app\core\DeleteModelAction',
                'modelClass' => [
                    'class' => 'app\models\Role'
                ]
            ],
		];
	}
	
	/**
	 * 授权
	 *
	 * @param string $name
	 * @return string
	 */
	public function actionPermission($name)
	{
	    $model = AuthRole::findOne(['name'=>$name]);
	    
	    // 角色已经拥有的权限
	    $rights = ArrayHelper::getColumn($model->getChildren()->all(), "name");
	    
	    // 如果是是更新权限
	    if ($permissions = \Yii::$app->request->post('permission')) {
	        
	        // array_diff 结果是包含在第一个数组，不包含在第二个数组
	        $adds = array_diff($permissions, $rights);
	        $dels = array_diff($rights, $permissions);
	        \Yii::$app->db->beginTransaction();
	        try {
	            // 删除取消的权限
	            if ($dels) {
	                
	                AuthItemChild::deleteAll([
	                    'parent' => $name,
	                    'child' => $dels
	                ]);
	            }
	            // 添加新的权限
	            $rows = array_map(function ($val) use ($name) {
	                return [
	                    $name,
	                    $val
	                ];
	            }, $adds);
	                // BaseVarDumper::dump($rows);die;
	                \Yii::$app->db->createCommand()
	                ->batchInsert(AuthItemChild::tableName(), [
	                    'parent',
	                    'child'
	                ], $rows)
	                ->execute();
	                \Yii::$app->db->getTransaction()->commit();
	                \Yii::$app->session->setFlash("success", "权限更新成功！");
	                //删除缓存
	                \Yii::$app->cache && \Yii::$app->cache->delete('rbac');
	        } catch (\Exception $e) {
	            \Yii::$app->db->getTransaction()->rollBack();
	            \Yii::$app->session->setFlash("error", "更新失败，系统错误：" . $e->getCode());
	        }
	        return $this->redirect(\Yii::$app->request->url);
	    }
	    
	    $query = (new Query())->from(AuthItem::tableName())
	    ->where([
	        'type' => [
	            AuthItem::TYPE_PERMISSION,
	            AuthItem::TYPE_MODULE
	        ]
	    ])
	    ->leftJoin(AuthItemChild::tableName(), AuthItem::tableName() . '.name = ' . AuthItemChild::tableName() . '.child');
	    
	    $dataProvider = new ActiveDataProvider([
	        'query' => $query,
	        'pagination' => false
	    ]);
	    
	    return $this->render("permission", [
	        'model' => $model,
	        'rights' => $rights,
	        'dataProvider' => $dataProvider
	    ]);
	}
}
