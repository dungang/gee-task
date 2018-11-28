<?php
namespace app\models;

use Yii;

/**
 * This is the model class for table "gt_role".
 *
 * @property int $id
 * @property string $name 名称
 * @property string $scope 范围
 * @property string $description 说明
 */
class Role extends \app\core\BaseModel
{

    /**
     *
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gt_role';
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
                    'description'
                ],
                'required'
            ],
            [
                [
                    'scope'
                ],
                'string'
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
                    'description'
                ],
                'string',
                'max' => 255
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
            'id' => 'ID',
            'name' => '名称',
            'scope' => '范围',
            'description' => '说明'
        ];
    }

    public function init()
    {
        parent::init();
        $this->on(self::EVENT_BEFORE_INSERT, function ($event) {
            $role = new AuthRole();
            $role->name = $this->name;
            $role->save(false);
        });
        $this->on(self::EVENT_BEFORE_UPDATE, function ($event) {
            $oldName = $this->getOldAttribute("name");
            $role = AuthRole::findOne([
                'name' => $oldName
            ]);
            $role->name = $this->name;
            $role->save(false);
        });
        $this->on(self::EVENT_BEFORE_DELETE, function ($event) {
            AuthRole::deleteAll([
                'name' => $this->name
            ]);
        });
    }

    /**
     *
     * {@inheritdoc}
     * @return RoleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RoleQuery(get_called_class());
    }
}
