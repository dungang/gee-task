<?php

namespace modules\sprint\models;

/**
 * This is the ActiveQuery class for [[Sprint]].
 *
 * @see Sprint
 */
class SprintQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Sprint[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Sprint|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
