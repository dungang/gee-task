<?php
namespace app\widgets;

use yii\bootstrap\Modal;
use yii\bootstrap\Html;
use yii\web\JsExpression;

class SimpleModal extends Modal
{

    public function run()
    {
        echo "\n" . $this->renderBodyEnd();
        echo "\n" . $this->renderFooter();
        echo "\n" . Html::endTag('div'); // modal-content
        echo "\n" . Html::endTag('div'); // modal-dialog
        echo "\n" . Html::endTag('div');
        $view = $this->getView();
        $view->registerjs($this->getJs('#' . $this->options['id']));
    }

    public function getJs($selector)
    {
        return new JsExpression(
            "(function(modalSelector) {
	var modal = $(modalSelector);
	modal.on('hidden.bs.modal', function(e) {
		// 清空对象
		$(e.target).data('bs.modal', null);
	});
	modal.on('show.bs.modal', function(e) {
		var size = $(e.relatedTarget).data('modal-size');
		$(e.target).find('.modal-dialog').removeClass('modal-sm modal-lg').addClass(size ? size : '');
	});
})('{$selector}')");
    }
}

