<?php

namespace app\models;

use yii\db\Query;

/**
 * This is the model class for table "gt_project".
 *
 * @property int $id
 * @property string $name 名称
 * @property string $web_site 官网
 * @property int $is_achived 归档
 * @property int $creator_id 创始人
 * @property int $created_at 添加日期
 * @property int $updated_at 更新日期
 * @property int $is_del
 */
class Project extends \app\core\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gt_project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'creator_id'], 'required'],
            [['is_achived', 'creator_id', 'created_at', 'updated_at', 'is_del'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['web_site'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'web_site' => '官网',
            'is_achived' => '归档',
            'creator_id' => '创始人',
            'created_at' => '添加日期',
            'updated_at' => '更新日期',
            'is_del' => 'Is Del',
        ];
    }
    
    public function init(){
        parent::init();
        $this->on(self::EVENT_AFTER_INSERT,function($event){
            $mem = new ProjectMember([
                'project_id'=>$this->id,
                'user_id'=>$this->creator_id,
                'position'=>'项目负责人'
            ]);
            $mem->save(false);
        });
    }

    /**
     * {@inheritdoc}
     * @return ProjectQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectQuery(get_called_class());
    }
    
    public static function loadJoinedProjectsQuery($select){
        $query = (new Query());
        return $query->select($select)
        ->from(['p'=>Project::tableName(),'pm'=>ProjectMember::tableName()])
        ->where('p.id = pm.project_id')
        ->andWhere(['pm.user_id'=>\Yii::$app->user->id, 'p.is_del'=>0]);
    }
    
}
