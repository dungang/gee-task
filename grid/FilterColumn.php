<?php
namespace app\grid;

use yii\helpers\ArrayHelper;
use yii\grid\DataColumn;

class FilterColumn extends DataColumn
{
    /**
     *
     * {@inheritdoc}
     * @see \yii\base\BaseObject::init()
     */
    public function init()
    {
        parent::init();
        $this->format = 'html';
        if(!$this->filterInputOptions){
           $this->filterInputOptions = []; 
        }
        $this->filterInputOptions = array_merge($this->filterInputOptions,['encode'=>false]);
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
            $val = ArrayHelper::getValue($model, $this->attribute);
            if($this->filter) {
                return isset($this->filter[$val]) ? $this->filter[$val]: $val;
            } else {
                return $val;
            }
        }
        
        return null;
    }
}

