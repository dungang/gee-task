<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\helpers\MiscHelper;

/**
 * This is the model class for table "gt_project_member".
 *
 * @property int $project_id 组织
 * @property int $user_id 成员
 * @property string $position 岗位
 */
class ProjectMember extends \app\core\BaseModel
{
    public $username;
    
    public $nick_name;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gt_project_member';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'position'], 'required'],
            [['project_id', 'user_id'], 'integer'],
            [['position'], 'string', 'max' => 64],
            [['project_id', 'user_id'], 'unique', 'targetAttribute' => ['project_id', 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'project_id' => '项目',
            'user_id' => '成员',
            'username' => '账号',
            'nick_name' => '姓名',
            'position' => '岗位',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProjectMemberQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectMemberQuery(get_called_class());
    }
    
    public static function allIdToName($key = 'id', $val = 'name',$where=[],$orderBy=null)
    {
        $models = self::find()->select("$key,$val")->innerJoin(['u'=>User::tableName()],'user_id = u.id')->where($where)->orderBy($orderBy)->asArray()->all();
        if (is_array($models)) {
            return ArrayHelper::map($models, $key, $val);
        }
        return $models;
    }
    
    public static function onePrjectMemIdNames(){
        return self::allIdToName('user_id','nick_name',['project_id'=>MiscHelper::getProjectId()]);
    }
}
