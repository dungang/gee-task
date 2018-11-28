<?php
namespace app\behaviors;

use yii\base\Behavior;
use yii\db\ActiveRecord;
use app\models\Event;

class TriggerCustomEventOnSave extends Behavior
{
    public $customEventName;
    
    public function events() {
       return [
           ActiveRecord::EVENT_AFTER_INSERT => 'triggerCustomEvent',
           ActiveRecord::EVENT_AFTER_UPDATE => 'triggerCustomEvent',
       ];
    }
    
    public function triggerCustomEvent($event){
        Event::triggerCustomEvent($this->customEventName,$event);
    }
}

