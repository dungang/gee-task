<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gt_change_category".
 *
 * @property int $id
 * @property string $name 名称
 */
class ChangeCategory extends \app\core\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gt_change_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string'],
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
        ];
    }

    /**
     * {@inheritdoc}
     * @return ChangeCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ChangeCategoryQuery(get_called_class());
    }
}
