<?php

namespace modules\change\models;

/**
 * This is the ActiveQuery class for [[Change]].
 *
 * @see Change
 */
class ChangeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Change[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Change|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
