<?php

namespace modules\sprint\models;

/**
 * This is the ActiveQuery class for [[StoryAttachment]].
 *
 * @see StoryAttachment
 */
class StoryAttachmentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return StoryAttachment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return StoryAttachment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
