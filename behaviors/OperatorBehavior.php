<?php
namespace app\behaviors;

use yii\behaviors\AttributeBehavior;
use yii\db\BaseActiveRecord;
use yii\base\InvalidCallException;
use yii\db\ActiveRecord;
use yii\base\Event;
use yii\web\Application;

class OperatorBehavior extends AttributeBehavior
{

    public $creatorIdAttribute = 'creator_id';

    public $updatorIdAttribute = 'updator_id';

    public $value;

    /**
     *
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        if (empty($this->attributes)) {
            $this->attributes = [
                BaseActiveRecord::EVENT_BEFORE_INSERT => [
                    $this->creatorIdAttribute,
                    $this->updatorIdAttribute
                ],
                BaseActiveRecord::EVENT_BEFORE_UPDATE => $this->updatorIdAttribute
            ];
        }
    }

    protected function getValue($event)
    {
        if ($this->value === null && \Yii::$app instanceof Application && ! \Yii::$app->user->isGuest) {
            return \Yii::$app->user->id;
        }

        return parent::getValue($event);
    }

    public function touch($attribute)
    {
        /* @var $owner BaseActiveRecord */
        $owner = $this->owner;

        if ($owner->hasAttribute($attribute)) {
            if ($owner->getIsNewRecord()) {
                throw new InvalidCallException('Updating the user id is not possible on a new record.');
            }
            $owner->updateAttributes(array_fill_keys((array) $attribute, $this->getValue(null)));
        }
    }

    /**
     * Evaluates the attribute value and assigns it to the current attributes.
     *
     * @param Event $event
     */
    public function evaluateAttributes($event)
    {
        if ($this->skipUpdateOnClean && $event->name == ActiveRecord::EVENT_BEFORE_UPDATE && empty($this->owner->dirtyAttributes)) {
            return;
        }
        /* @var $owner BaseActiveRecord */
        $owner = $this->owner;
        if (! empty($this->attributes[$event->name])) {
            $attributes = (array) $this->attributes[$event->name];
            $value = $this->getValue($event);
            foreach ($attributes as $attribute) {
                // ignore attribute names which are not string (e.g. when set by TimestampBehavior::updatedAtAttribute)
                if (is_string($attribute) && $owner->hasAttribute($attribute)) {
                    if ($this->preserveNonEmptyValues && ! empty($this->owner->$attribute)) {
                        continue;
                    }
                    $this->owner->$attribute = $value;
                }
            }
        }
    }
}

