<?php

namespace modules\link\models;

use Yii;

/**
 * This is the model class for table "gt_link".
 *
 * @property int $id
 * @property int $project_id 项目
 * @property string $label 名称
 * @property string $url 地址
 */
class Link extends \app\core\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gt_link';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'label', 'url'], 'required'],
            [['project_id'], 'integer'],
            [['label'], 'string', 'max' => 32],
            [['url'], 'string', 'max' => 128],
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
            'label' => '名称',
            'url' => '地址',
        ];
    }

    /**
     * {@inheritdoc}
     * @return LinkQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LinkQuery(get_called_class());
    }
}
