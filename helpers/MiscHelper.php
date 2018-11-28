<?php
namespace app\helpers;

use app\filters\SwitchProjectFilter;
use yii\base\NotSupportedException;
use yii\helpers\Html;
use app\filters\AccessFilter;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use app\models\User;
use app\models\ProjectMember;

/**
 * 项目工具类
 * @author dungang
 *
 */
class MiscHelper
{
    
    public static function getProjectId(){
        return \Yii::$app->session->get(SwitchProjectFilter::SWITCH_PROJECT_ID);
    }
    
    public static function getProject(){
        $id = self::getProjectId();
        $projects = \Yii::$app->session->get(SwitchProjectFilter::SWITCH_PROJECTS);
        if($id && isset($projects[$id])){
            return $projects[$id];
        }
        return null;
    }
    
    public static function betweenDayWithTimestamp($field,$date) {
        if($date) {
            $start = strtotime($date);
            $end  = 24 * 3600 + $start;
            return ['between',$field,$start, $end];
        }
        return [];
    }
    
    /**
     * 根据项目id查询股东的id和名称的信息
     * @param int $project_id
     * @return array|array[]
     */
    public static function orgMemberNames($project_id){
        $query  = new Query();
        $membs =  $query->select('id,name')->from(['m'=>User::tableName(),'om'=>ProjectMember::tableName()])
        ->where('m.id=om.mem_id')
        ->andWhere(['om.project_id'=>$project_id])->all();
        return ArrayHelper::map($membs, 'id', 'name');
    }
    
    public static function memberNames($ids) {
        $query  = new Query();
        $membs =  $query->select('id,name')->from(User::tableName())
        ->where(['id'=>$ids])->all();
        return ArrayHelper::map($membs, 'id', 'name');
    }
    
    /**
     * 用户加入的项目
     * @return NULL|string[][][]|mixed[][][]
     */
    public static function switchProjectMenuItems(){
        $rootItem = null;
        $switchProjects = [];
        $_joined_projects = \Yii::$app->session->get(SwitchProjectFilter::SWITCH_PROJECTS);
        $_project_id = \Yii::$app->session->get(SwitchProjectFilter::SWITCH_PROJECT_ID);
        
        if(isset($_joined_projects) && is_array($_joined_projects)) {
            foreach($_joined_projects as $project_id => $org) {
                if($project_id == $_project_id) {
                    $rootItem = [
                        'label'=>$org['name'],
                        'url'=>['/space','id'=>$org['id']]
                    ];
                } 
                //else {
                    $switchProjects[] = [
                        'label'=>$org['name'],
                        'url'=>['/switch-project','id'=>$org['id']]
                    ];
                //}
            }
            if($rootItem == null) {
                $rootItem = array_shift($switchProjects);
            }
            $rootItem['items'] = $switchProjects;
        }
        return $rootItem;
    }

    
    /**
     *
     * @param string $text
     * @param array $url
     * @param array $options
     * @return string
     */
    public static function orgLinkButton($text, $url, $options)
    {
        if (is_array($url)) {
            return self::hasProjectPermission($url[0]) ? Html::a($text, $url, $options) : '';
        }
        throw new NotSupportedException('argment url be must an array!');
    }
    
    /**
     *
     * @param array $action
     * @param string $content
     * @param array $options
     * @throws NotSupportedException
     * @return string
     */
    public static function orgSubmitButton( $action,  $content = '',  $options = [])
    {
        if (is_array($action)) {
            return self::hasProjectPermission($action[0]) ? Html::SubmitButton($content, $options) : '';
        }
        throw new NotSupportedException('argment url be must an array!');
    }

    
    public static  function hasProjectPermission($route)
    {
        /* @var AccessFilter $aclFilter */
        $aclFilter = \Yii::$app->controller->getBehavior(AccessFilter::ID);
        return $aclFilter->hasPermission($route);
    }
    
}

