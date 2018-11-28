<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[RobotMessage]].
 *
 * @see RobotMessage
 */
class RobotMessageQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RobotMessage[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RobotMessage|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
