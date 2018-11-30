<?php
namespace app\behaviors;

use yii\base\Behavior;
use app\models\Event;

class TriggerCustomEventOnSave extends Behavior
{

    public $customEvents = [];

    public function events()
    {
        $events = [];
        foreach (array_keys($this->customEvents) as $event) {
            $events[$event] = 'triggerCustomEvent';
        }
        return $events;
    }

    public function triggerCustomEvent($event)
    {
        if ($this->customEvents[$event->name]) {
            Event::triggerCustomEvent($this->customEvents[$event->name], $this->owner);
        }
    }
}

