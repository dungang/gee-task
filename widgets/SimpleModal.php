<?php
namespace app\widgets;

use yii\bootstrap\Modal;
use yii\bootstrap\Html;

class SimpleModal extends Modal
{
    public function run(){
        echo "\n" . $this->renderBodyEnd();
        echo "\n" . $this->renderFooter();
        echo "\n" . Html::endTag('div'); // modal-content
        echo "\n" . Html::endTag('div'); // modal-dialog
        echo "\n" . Html::endTag('div');
        $view = $this->getView();
        $view->registerJs("
            $('#".$this->options['id']."').on('hidden.bs.modal', function() { $(this).removeData('bs.modal')});
            var eventsData = $.data(document,'events') || $._data(document,'events');
            for(var p in eventsData.click){
                var event = eventsData.click[p];
                if(event.namespace='click.bs.modal.data-api' && event.selector=='[data-toggle=\"modal\"]'){
                    var handler = event.handler;
                    eventsData.click.splice(p,1);
                    $(document).on('click.customer.modal.data-api', '[data-toggle=modal]', function (e) {
                    	var _this   = $(this)
                    	var _target = $(_this.attr('data-target') || (href && href.replace(/.*(?=#[^\s]+$)/, ''))) // strip for ie7
                        _target.modal('removeBackdrop');
                    	_target.trigger('hidden.bs.modal');
                    });
                    $(document).on('click.bs.modal.data-api', '[data-toggle=modal]', handler);
                    break;
                }
            }
        ");
    }
}

