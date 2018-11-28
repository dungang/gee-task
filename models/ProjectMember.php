<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gt_project_member".
 *
 * @property int $project_id 组织
 * @property int $user_id 成员
 * @property string $position 岗位
 */
class ProjectMember extends \app\core\BaseModel
{
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
            [['project_id', 'user_id', 'position'], 'required'],
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
            'project_id' => '组织',
            'user_id' => '成员',
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
}
