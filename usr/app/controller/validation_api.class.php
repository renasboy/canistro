<?php
namespace app\controller;

class validation_api extends \app\simple_controller {

    protected $_default_input  = [
        'method'    => [],
        'value'     => []
    ];

    protected function _validate_input () {

        $this->_validator->validate('is_in_list', $this->_input['method'], ['email', 'name']);
        $this->_validator->validate('is_text', $this->_input['value']);

        if ($this->_validator->error()) {
            $this->_error->bad_request('validation api:' . $this->_validator->error());
        }
    }

    protected function _execute () {
        $validation = true;

        $this->_validator->validate('is_not_entity', 'store', $this->_input['method'], $this->_input['value']);

        if ($this->_validator->error()) {
            $this->_logger->error('validation api: ' . $this->_validator->error());
            $validation = false;
        }
        $this->_view->set('validation', $validation);
    }
}
