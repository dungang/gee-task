<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[StoryStatus]].
 *
 * @see StoryStatus
 */
class StoryStatusQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return StoryStatus[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return StoryStatus|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
