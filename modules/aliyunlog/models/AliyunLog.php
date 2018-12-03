<?php

namespace modules\aliyunlog\models;

use Yii;

/**
 * This is the model class for table "gt_aliyun_log".
 *
 * @property int $project_id 项目
 * @property string $endpoint
 * @property string $access_key
 * @property string $secret_key
 */
class AliyunLog extends \app\core\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gt_aliyun_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'endpoint', 'access_key', 'secret_key'], 'required'],
            [['project_id'], 'integer'],
            [['endpoint', 'access_key', 'secret_key'], 'string', 'max' => 64],
            [['project_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'project_id' => '项目',
            'endpoint' => 'Endpoint',
            'access_key' => 'Access Key',
            'secret_key' => 'Secret Key',
        ];
    }

    /**
     * {@inheritdoc}
     * @return AliyunLogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AliyunLogQuery(get_called_class());
    }
}
