<?php
namespace app\behaviors;

use yii\base\InvalidCallException;
use yii\db\BaseActiveRecord;
use yii\behaviors\AttributeBehavior;
use yii\base\Event;
use yii\db\ActiveRecord;

class TimestampBehavior extends AttributeBehavior
{

    /**
     *
     * @var string the attribute that will receive timestamp value
     *      Set this property to false if you do not want to record the creation time.
     */
    public $createdAtAttribute = 'created_at';

    /**
     *
     * @var string the attribute that will receive timestamp value.
     *      Set this property to false if you do not want to record the update time.
     */
    public $updatedAtAttribute = 'updated_at';

    /**
     *
     * {@inheritdoc} In case, when the value is `null`, the result of the PHP function [time()](http://php.net/manual/en/function.time.php)
     *               will be used as value.
     */
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
                    $this->createdAtAttribute,
                    $this->updatedAtAttribute,
                ],
                BaseActiveRecord::EVENT_BEFORE_UPDATE => $this->updatedAtAttribute
            ];
        }
    }

    /**
     *
     * {@inheritdoc} In case, when the [[value]] is `null`, the result of the PHP function [time()](http://php.net/manual/en/function.time.php)
     *               will be used as value.
     */
    protected function getValue($event)
    {
        if ($this->value === null) {
            return time();
        }
        
        return parent::getValue($event);
    }

    /**
     * Updates a timestamp attribute to the current timestamp.
     *
     * ```php
     * $model->touch('lastVisit');
     * ```
     *
     * @param string $attribute
     *            the name of the attribute to update.
     * @throws InvalidCallException if owner is a new record (since version 2.0.6).
     */
    public function touch($attribute)
    {
        /* @var $owner BaseActiveRecord */
        $owner = $this->owner;
        if ($owner->getIsNewRecord()) {
            
            throw new InvalidCallException('Updating the timestamp is not possible on a new record.');
        }
        
        $owner->updateAttributes(array_fill_keys((array) $attribute, $this->getValue(null)));
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


