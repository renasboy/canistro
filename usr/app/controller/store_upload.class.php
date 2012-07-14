<?php
namespace app\controller;

class store_upload extends \app\simple_controller {

    protected $_default_input   = [
        'name'                  => null,
        'file'                  => null
    ];

    protected function _validate_input () {
        $this->_validator->validate('is_entity', 'store', 'name', $this->_input['name']);
        if ($this->_validator->error()) {
            $this->_error->not_found('store: ' . $this->_input['name']);
        }
        
        // check authentication
        $auth_store = $this->_session->get('auth', 'store'); 
        
        if (!$auth_store || $auth_store->name != $this->_input['name']) {
            $this->_error->unauthorized('product at store: ' . $this->_input['name']);
        }

        if ($this->_request->method() != 'post') {
            $this->_error->bad_request('product without POST');
        }
        
        $this->_validator->validate('is_image', $this->_input['file']);

        if ($this->_validator->error()) {
            $this->_logger->error('UPLOAD: validation with error: ' . $this->_validator->error());
            die('error');
        }

    }

    protected function _execute () {

        $auth_store = $this->_session->get('auth', 'store');

        $img    = sprintf('tmp/%s-%s.noext', $auth_store->name, $this->_request->time());
        $name   = $this->_conf->get('image_root') . '/' . $img;
        if (!move_uploaded_file($this->_input['file']['tmp_name'], $name)) {
            $this->_logger->error('UPLOAD: failed with data:' . print_r($this->_input['file'], true));
            die('error');
        }
        die($img);
    }
}
