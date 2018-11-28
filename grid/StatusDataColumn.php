<?php
namespace app\grid;

use yii\grid\Column;
use Closure;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\StringHelper;

/**
 * @author dungang@126.com
 * @since 2.0
 */
class StatusDataColumn extends Column
{
    /**
     * @var string the attribute name associated with this column. When neither [[content]] nor [[value]]
     * is specified, the value of the specified attribute will be retrieved from each data model and displayed.
     *
     * Also, if [[label]] is not specified, the label associated with the attribute will be displayed.
     */
    public $attribute;
    /**
     * @var string label to be displayed in the [[header|header cell]] and also to be used as the sorting
     * link label when sorting is enabled for this column.
     * If it is not set and the models provided by the GridViews data provider are instances
     * of [[\yii\db\ActiveRecord]], the label will be determined using [[\yii\db\ActiveRecord::getAttributeLabel()]].
     * Otherwise [[\yii\helpers\Inflector::camel2words()]] will be used to get a label.
     */
    public $label;
    
    public $encodeLabel = true;
    
    /**
     * 所有的状态
     * @var array
     */
    public $allStatus = [];
    /**
     * @var string|Closure an anonymous function or a string that is used to determine the value to display in the current column.
     *
     * If this is an anonymous function, it will be called for each row and the return value will be used as the value to
     * display for every data model. The signature of this function should be: `function ($model, $key, $index, $column)`.
     * Where `$model`, `$key`, and `$index` refer to the model, key and index of the row currently being rendered
     * and `$column` is a reference to the [[DataColumn]] object.
     *
     * You may also set this property to a string representing the attribute name to be displayed in this column.
     * This can be used when the attribute to be displayed is different from the [[attribute]] that is used for
     * sorting and filtering.
     *
     * If this is not set, `$model[$attribute]` will be used to obtain the value, where `$attribute` is the value of [[attribute]].
     */
    public $value;
    
    /**
     * @var string|array|Closure in which format should the value of each data model be displayed as (e.g. `"raw"`, `"text"`, `"html"`,
     * `['date', 'php:Y-m-d']`). Supported formats are determined by the [[GridView::formatter|formatter]] used by
     * the [[GridView]]. Default format is "text" which will format the value as an HTML-encoded plain text when
     * [[\yii\i18n\Formatter]] is used as the [[GridView::$formatter|formatter]] of the GridView.
     * @see \yii\i18n\Formatter::format()
     */
    public $format = 'text';
    
    private $_wordWidth = 0;
    
    private $_statsuKeyWidths = [];
    
    public $width = 0;
    
    public function init(){
        $size = 0;
        $keyWordsNumber = [];
        foreach ($this->allStatus as $key=>$val){
            $keyWordsNumber[$key] = StringHelper::byteLength($val);
            $size += $keyWordsNumber[$key];
        }
        if($size > 0 ) {
            $this->_wordWidth = $this->width / $size;
            $this->_statsuKeyWidths = array_map(function($number) use(&$total){
                return round($this->_wordWidth * $number,2);
            }, $keyWordsNumber);
        }
        
    }

    
    /**
     * Renders the header cell.
     */
    public function renderHeaderCell()
    {
        return $this->renderHeaderCellContent();
    }
    
    
    /**
     * {@inheritdoc}
     */
    protected function renderHeaderCellContent()
    {
        $headers = "";
        foreach($this->allStatus as $key=>$val) {
            $widthOptions = [];
            if($this->_wordWidth > 0 ) {
                $widthOptions['width']=$this->_statsuKeyWidths[$key] . "px";
            }
            $headers .= Html::tag('th', $val, ArrayHelper::merge($this->headerOptions,$widthOptions));
        }
        return $headers;
    }
    
    
    /**
     * Renders the footer cell.
     */
    public function renderFooterCell()
    {
        return Html::tag('td', $this->renderFooterCellContent(), $this->footerOptions);
    }
    
    /**
     * Renders a data cell.
     * @param mixed $model the data model being rendered
     * @param mixed $key the key associated with the data model
     * @param int $index the zero-based index of the data item among the item array returned by [[GridView::dataProvider]].
     * @return string the rendering result
     */
    public function renderDataCell($model, $key, $index)
    {
        return  $this->renderDataCellContent($model, $key, $index);
    }
    
    /**
     * Returns the data cell value.
     * @param mixed $model the data model
     * @param mixed $key the key associated with the data model
     * @param int $index the zero-based index of the data model among the models array returned by [[GridView::dataProvider]].
     * @return string the data cell value
     */
    public function getDataCellValue($model, $key, $index)
    {
        if ($this->value !== null) {
            if (is_string($this->value)) {
                return ArrayHelper::getValue($model, $this->value);
            }
            
            return call_user_func($this->value, $model, $key, $index, $this);
        } elseif ($this->attribute !== null) {
            return ArrayHelper::getValue($model, $this->attribute);
        }
        
        return null;
    }
    
    /**
     * {@inheritdoc}
     */
    protected function renderDataCellContent($model, $key, $index)
    {
        if ($this->contentOptions instanceof Closure) {
            $options = call_user_func($this->contentOptions, $model, $key, $index, $this);
        } else {
            $options = $this->contentOptions;
        }
        
        $dataCells = "";
        foreach($this->allStatus as $code=>$name) {
            $content = "";
            if($code == $model[$this->attribute]) {
                $content = $this->getDataCellValue($model, $key, $index);
            }
            
            $widthOptions = [];
            if($this->_wordWidth > 0 ) {
                $widthOptions['width']=$this->_statsuKeyWidths[$code]  . "px";;
            }
            $dataCells .= Html::tag('td', $content, ArrayHelper::merge($options,$widthOptions));
        }
        return $dataCells;
    }
}

