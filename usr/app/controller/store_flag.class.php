<?php
namespace app\controller;

class store_flag extends \app\simple_controller {

    protected $_default_input   = [
        'name'                  => null,
        'id'                    => null
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
        
        $this->_validator->validate('is_entity', 'product', 'id', $this->_input['id'], [ 'store' => $this->_input['name']]);

        if ($this->_validator->error()) {
            $this->_error->bad_request('flag: ' . $this->_validator->error());
        }

    }

    protected function _execute () {
        $product    = $this->_api_client->get('/product/' . $this->_input['id'], [])[0];

        if (empty($product->active)) {
            $input = [ 'active' => 1 ];
        }
        else {
            $input = [ 'active' => 'FALSE' ];
        }

        $result = $this->_api_client->save('/product/' . $this->_input['id'], $input);
        if (!$result) {
            $this->_error->internal_server_error('save product with data: ' . print_r($input, true));
        }
        die('success');
    }
}
