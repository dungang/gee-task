<?php

namespace modules\sprint\models;

/**
 * This is the ActiveQuery class for [[Story]].
 *
 * @see Story
 */
class StoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Story[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Story|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
