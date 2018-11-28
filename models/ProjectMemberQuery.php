<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ProjectMember]].
 *
 * @see ProjectMember
 */
class ProjectMemberQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjectMember[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjectMember|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
