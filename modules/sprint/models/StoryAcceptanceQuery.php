<?php

namespace modules\sprint\models;

/**
 * This is the ActiveQuery class for [[StoryAcceptance]].
 *
 * @see StoryAcceptance
 */
class StoryAcceptanceQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return StoryAcceptance[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return StoryAcceptance|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
