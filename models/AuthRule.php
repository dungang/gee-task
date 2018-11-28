<?php
namespace app\models;

use Yii;
use app\core\BaseModel;

/**
 * This is the model class for table "auth_rule".
 *
 * @property string $name
 * @property resource $data
 * @property int $created_at
 * @property int $updated_at
 *
 * @property AuthItem[] $authItems
 */
class AuthRule extends BaseModel
{

    /**
     *
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auth_rule';
    }

    /**
     *
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'name'
                ],
                'required'
            ],
            [
                [
                    'data'
                ],
                'string'
            ],
            [
                [
                    'created_at',
                    'updated_at'
                ],
                'integer'
            ],
            [
                [
                    'name'
                ],
                'string',
                'max' => 64
            ],
            [
                [
                    'name'
                ],
                'unique'
            ]
        ];
    }

    /**
     *
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => '名称',
            'data' => '数据',
            'created_at' => '添加时间',
            'updated_at' => '更新时间'
        ];
    }

    public function save($runValidation = true, $attributeNames = NULL){
        if($runValidation && $this->validate()) {
            $rule = \Yii::createObject($this->name);
            $rule->name = $this->name;
            if($this->isNewRecord){
                return \Yii::$app->authManager->add($rule);
            } else {
                return \Yii::$app->authManager->update($this->name,$rule);
            }
        }
        return false;
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthItems()
    {
        return $this->hasMany(AuthItem::className(), [
            'rule_name' => 'name'
        ]);
    }

    /**
     *
     * {@inheritdoc}
     * @return AuthRuleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AuthRuleQuery(get_called_class());
    }
}
