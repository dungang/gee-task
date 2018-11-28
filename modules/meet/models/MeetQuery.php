<?php

namespace modules\meet\models;

/**
 * This is the ActiveQuery class for [[Meet]].
 *
 * @see Meet
 */
class MeetQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Meet[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Meet|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
