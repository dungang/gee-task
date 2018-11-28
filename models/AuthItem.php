<?php
namespace app\models;

use Yii;
use app\core\BaseModel;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "auth_item".
 *
 * @property string $name
 * @property int $type
 * @property string $description
 * @property string $rule_name
 * @property resource $data
 * @property int $created_at
 * @property int $updated_at
 *
 * @property AuthAssignment[] $authAssignments
 * @property AuthRule $ruleName
 * @property AuthItemChild[] $authItemChildren
 * @property AuthItem[] $children
 * @property AuthItem[] $parents
 */
class AuthItem extends BaseModel
{

    /**
     * 角色
     *
     * @var integer
     */
    const TYPE_ROLE = 1;

    /**
     * 权限
     * @var integer
     */
    const TYPE_PERMISSION = 2;

    /**
     * 模块
     * @var integer
     */
    const TYPE_MODULE = 3;

    /**
     * 路由
     * @var integer
     */
    const TYPE_ROUTE = 4;


    /**
     *
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auth_item';
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
                    'name',
                    'type'
                ],
                'required'
            ],
            [
                [
                    'type',
                    'created_at',
                    'updated_at'
                ],
                'integer'
            ],
            [
                [
                    'description',
                    'data'
                ],
                'string'
            ],
            [
                [
                    'name',
                    'rule_name'
                ],
                'string',
                'max' => 64
            ],
            [
                [
                    'name'
                ],
                'unique'
            ],
            [
                [
                    'rule_name'
                ],
                'exist',
                'skipOnError' => true,
                'targetClass' => AuthRule::className(),
                'targetAttribute' => [
                    'rule_name' => 'name'
                ]
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
            'type' => '类型',
            'description' => '介绍',
            'rule_name' => '规则',
            'data' => '数据',
            'created_at' => '添加时间',
            'updated_at' => '更新时间'
        ];
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthAssignments()
    {
        return $this->hasMany(AuthAssignment::className(), [
            'item_name' => 'name'
        ]);
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRuleName()
    {
        return $this->hasOne(AuthRule::className(), [
            'name' => 'rule_name'
        ]);
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthItemChildren()
    {
        return $this->hasMany(AuthItemChild::className(), [
            'parent' => 'name'
        ]);
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChildren()
    {
        return $this->hasMany(AuthItem::className(), [
            'name' => 'child'
        ])->viaTable('auth_item_child', [
            'parent' => 'name'
        ]);
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParents()
    {
        return $this->hasMany(AuthItem::className(), [
            'name' => 'parent'
        ])->viaTable('auth_item_child', [
            'child' => 'name'
        ]);
    }
    
    public static function allIdToName($key = 'id', $val = 'name', $type=AuthItem::TYPE_ROLE)
    {
        $models = self::find()->select("$key,$val")->where(['type'=>$type])->asArray()->all();
        if (is_array($models)) {
            return ArrayHelper::map($models, $key, $val);
        }
        return $models;
    }
    
}
