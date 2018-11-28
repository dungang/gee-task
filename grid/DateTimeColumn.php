<?php
namespace app\grid;

use yii\grid\DataColumn;
use app\widgets\DatePicker;

class DateTimeColumn extends DataColumn
{
    public $dateFormat = [
        'date'=>'yyyy-mm-dd',
        'datetime'=>'yyyy-mm-dd H:i:s'
    ];
    /**
     * {@inheritdoc}
     */
    protected function renderFilterCellContent()
    {
        return DatePicker::widget([
            'model'=>$this->grid->filterModel,
            'attribute'=>$this->attribute,
            'format'=>$this->dateFormat[$this->format]
        ]);
    }
}

