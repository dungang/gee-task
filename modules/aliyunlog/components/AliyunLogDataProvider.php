<?php
namespace modules\aliyunlog\components;
use yii\data\BaseDataProvider;
use modules\aliyunlog\models\DataSearch;

class AliyunLogDataProvider extends BaseDataProvider
{
    /**
     * @var string|callable name of the key column or a callable returning it
     */
    public $key;

    /**
     * 阿里云日志查询模型类
     *
     * @var DataSearch
     */
    public $search;
    
    public function init(){
        $this->key = $this->search->key;
    }

    protected function prepareModels()
    {
        $pagination = $this->getPagination();
        $models = $this->search->getModels();
        if ($pagination !== false) {
            $pagination->totalCount = $this->getTotalCount();
        }
        return $models;
    }

    protected function prepareKeys($models)
    {
        if ($this->key !== null) {
            $keys = [];
            foreach ($models as $model) {
                if (is_string($this->key)) {
                    $keys[] = $model[$this->key];
                } else {
                    $keys[] = call_user_func($this->key, $model);
                }
            }
            return $keys;
        } else {
            return array_keys($models);
        }
    }

    protected function prepareTotalCount()
    {
        return $this->search->getCount();
    }
}

