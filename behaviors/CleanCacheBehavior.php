<?php
namespace app\behaviors;

use yii\base\Behavior;
use yii\db\ActiveRecord;

class CleanCacheBehavior extends Behavior
{

    public $cacheKey;

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_UPDATE => 'cleanCache',
            ActiveRecord::EVENT_AFTER_DELETE => 'cleanCache',
            ActiveRecord::EVENT_AFTER_INSERT => 'cleanCache'
        ];
    }

    public function cleanCache($event)
    {
        if ($this->cacheKey) {
            if (is_array($this->cacheKey)) {
                foreach ($this->cacheKey as $key) {
                    \Yii::$app->cache->delete($key);
                }
            } else {
                \Yii::$app->cache->delete($this->cacheKey);
            }
        }
    }
}

