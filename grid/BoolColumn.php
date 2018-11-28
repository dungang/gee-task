<?php
namespace app\grid;

use yii\helpers\ArrayHelper;
use yii\grid\DataColumn;

class BoolColumn extends DataColumn
{

    /**
     *
     * {@inheritdoc}
     * @see \yii\base\BaseObject::init()
     */
    public function init()
    {
        parent::init();
        $this->filter = [
            true => '是',
            false => '否'
        ];
        $this->format = 'html';
    }

    /**
     *
     * {@inheritdoc}
     * @see \yii\grid\DataColumn::getDataCellValue()
     */
    public function getDataCellValue($model, $key, $index)
    {
        if ($this->value !== null) {
            if (is_string($this->value)) {
                return ArrayHelper::getValue($model, $this->value);
            }
            return call_user_func($this->value, $model, $key, $index, $this);
        } elseif ($this->attribute !== null) {
            if (ArrayHelper::getValue($model, $this->attribute)) {
                return "<span class='text-success'>是</span>";
            } else {
                return "<span class='text-danger'>否</span>";
            }
        }

        return null;
    }
}

