<?php
namespace app\controller;

class store_info extends \app\simple_controller {

    protected $_default_input   = [
        'name'                  => null
    ];

    protected function _validate_input () {
        $this->_validator->validate('is_entity', 'store', 'name', $this->_input['name']);
        if ($this->_validator->error()) {
            $this->_error->not_found('store: ' . $this->_input['name']);
        }
    }

    protected function _execute () {
        $this->_view->set('store_name', $this->_input['name']);
    }
}
