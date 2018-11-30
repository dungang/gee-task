<?php

namespace modules\sprint\models;

use Yii;

/**
 * This is the model class for table "gt_sprint".
 *
 * @property int $id
 * @property int $project_id 项目
 * @property string $status 状态
 * @property string $start_date 开始日期
 * @property string $end_date 结束日期
 * @property int $created_at 添加时间
 * @property int $updated_at 更新时间
 * @property string $name 名称
 * @property int $is_del
 */
class Sprint extends \app\core\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gt_sprint';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id','name','status'], 'required'],
            [['project_id', 'created_at', 'updated_at', 'is_del'], 'integer'],
            [['status'], 'string'],
            [['start_date', 'end_date'], 'safe'],
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => '项目',
            'status' => '状态',
            'start_date' => '开始日期',
            'end_date' => '结束日期',
            'created_at' => '添加时间',
            'updated_at' => '更新时间',
            'name' => '名称',
            'is_del' => 'Is Del',
        ];
    }

    /**
     * {@inheritdoc}
     * @return SprintQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SprintQuery(get_called_class());
    }
}
