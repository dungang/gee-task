<?php
namespace app\models;


/**
 * 系统权限
 *
 * @author dungang
 *        
 */
class AuthPermission extends AuthItem
{

    public $child;

    public function init()
    {
        $this->type = parent::TYPE_PERMISSION;
        parent::init();
        $this->on(self::EVENT_AFTER_INSERT, function ($event) {
            if ($this->child) {
                $child = \Yii::$app->authManager->getPermission($this->child);
                $parent = \Yii::$app->authManager->getPermission($this->name);
                \Yii::$app->authManager->addChild($parent, $child);
            }
        });
            $this->on(self::EVENT_AFTER_UPDATE, function ($event) {
                $parent = \Yii::$app->authManager->getPermission($this->name);
                if ($this->child) {
                    $child = \Yii::$app->authManager->getPermission($this->child);
                    \Yii::$app->authManager->addChild($parent, $child);
                } else {
                    \Yii::$app->authManager->removeChildren($parent);
                }
            });
    }

    public function rules()
    {
        $rules = parent::rules();
        array_push($rules, [
            'child',
            'string'
        ]);
        return $rules;
    }

    /**
     *
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['child'] = '子权限';
        return $labels;
    }

}

