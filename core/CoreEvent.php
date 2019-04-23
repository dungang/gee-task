<?php
namespace app\core;

use yii\base\Event;

/**
 *
 * @author dungang
 */
class CoreEvent extends Event
{
    /**
     * 传递的值
     * @var mixed
     */
    public $payload;
}

