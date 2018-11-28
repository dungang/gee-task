<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Robot]].
 *
 * @see Robot
 */
class RobotQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Robot[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Robot|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
