<?php

namespace modules\sprint\models;

/**
 * This is the ActiveQuery class for [[StoryActive]].
 *
 * @see StoryActive
 */
class StoryActiveQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return StoryActive[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return StoryActive|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
