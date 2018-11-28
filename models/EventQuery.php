<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Event]].
 *
 * @see Event
 */
class EventQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Event[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Event|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
