<?php

namespace modules\aliyunlog\models;

/**
 * This is the ActiveQuery class for [[AliyunLog]].
 *
 * @see AliyunLog
 */
class AliyunLogQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AliyunLog[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AliyunLog|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
