<?php
namespace app\models;

use Yii;

/**
 * This is the model class for table "gt_setting".
 *
 * @property string $name 名称
 * @property string $title 标题
 * @property string $value 值
 */
class Setting extends \app\core\BaseModel
{

    const CacheKey = 'setting.vars';

    public static $settings;

    /**
     *
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gt_setting';
    }

    public function behaviors()
    {
        $b = parent::behaviors();
        $b['cleanCache'] = [
            'class' => 'app\behaviors\CleanCacheBehavior',
            'cacheKey' => self::CacheKey
        ];
        return $b;
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
                    'title'
                ],
                'required'
            ],
            [
                [
                    'value'
                ],
                'string'
            ],
            [
                [
                    'name',
                    'title'
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
            'title' => '标题',
            'value' => '值'
        ];
    }

    /**
     *
     * {@inheritdoc}
     * @return SettingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SettingQuery(get_called_class());
    }
    
    public static function getCacheSettings(){
        if (! ($vars = \Yii::$app->cache->get(self::CacheKey))) {
            $vars = self::find()->indexBy('name')
            ->asArray()
            ->all();
            \Yii::$app->cache->set(self::CacheKey, $vars);
        }
        return $vars;
    }

    public static function getSettings($name)
    {
        if (! self::$settings) {
            self::$settings = self::getCacheSettings();
        }
        if(self::$settings && isset(self::$settings[$name])) {
            return self::$settings[$name]['value'];
        }
        return null;
    }
}
