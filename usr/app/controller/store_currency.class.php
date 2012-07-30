<?php
namespace app\controller;

class store_currency extends \app\simple_controller {

    protected $_default_input   = [
        'name'                  => null,
        'currency'              => null
    ];

    protected function _validate_input () {
        $this->_validator->validate('is_entity', 'store', 'name', $this->_input['name']);
        if ($this->_validator->error()) {
            $this->_error->not_found('store: ' . $this->_input['name']);
        }
 
        // check authentication
        $auth_store = $this->_session->get('auth', 'store'); 
        
        if (!$auth_store || $auth_store->name != $this->_input['name']) {
            $this->_error->unauthorized('currency at store: ' . $this->_input['name']);
        }
        
        $this->_validator->validate('is_in_list', $this->_input['currency'], [ 'EUR', 'USD', 'GBP', 'AUD', 'BRL', 'INR', 'CAD', 'RUB' ]);

        if ($this->_validator->error()) {
            $this->_error->bad_request('currency: ' . $this->_validator->error());
        }

    }

    protected function _execute () {
        $input = [
            'name'          => $this->_input['name'],
            'offset_start'  => 0,
            'offset_end'    => 1,
        ];

        $store = $this->_api_client->get('/store', $input)[0];

        $input = [ 'currency' => $this->_input['currency'] ];

        $result = $this->_api_client->save('/store/' . $store->id, $input);
        if (!$result) {
            $this->_error->internal_server_error('save store currency with data: ' . print_r($input, true));
        }
        $this->_request->redirect('referer');
    }
}
