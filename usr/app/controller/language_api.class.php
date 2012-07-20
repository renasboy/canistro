<?php
namespace app\controller;

class language_api extends \app\simple_controller {

    protected $_default_input   = [
        'section'               => []
    ];

    protected function _validate_input () {

        $this->_validator->validate('is_in_list', $this->_input['section'], ['signup', 'store_js']);

        if ($this->_validator->error()) {
            $this->_error->bad_request('language api:' . $this->_validator->error());
        }
    }

    protected function _execute () {
        $this->_view->set('section', $this->_input['section']);
    }
}
