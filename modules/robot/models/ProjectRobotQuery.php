<?php

namespace modules\robot\models;

/**
 * This is the ActiveQuery class for [[ProjectRobot]].
 *
 * @see ProjectRobot
 */
class ProjectRobotQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjectRobot[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjectRobot|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
