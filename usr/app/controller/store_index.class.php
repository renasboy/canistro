<?php
namespace app\controller;

class store_index extends \app\simple_controller {

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
        // show cart only on index
        $this->_view->set('show_cart', true);
        $this->_view->set('store_name', $this->_input['name']);

        // TODO hack for the currency will be fixed soon
        $store      = $this->_api_client->get('/store', [ 'name' => $this->_input['name'], 'offset_end' => 1 ])[0];
        $currencies = [
            'EUR' => '&euro;',
            'USD' => '$',
            'GBP' => '&pound;',
            'CAD' => '$',
            'AUD' => '$',
            'BRL' => 'R$',
            'INR' => '₹ ',
            'RUB' => 'руб'
        ];
        $this->_view->set('store_currency', $currencies[$store->currency]);

        $auth_store = $this->_session->get('auth', 'store'); 
        
        if ($auth_store && $auth_store->name == $this->_input['name']) {
            $this->_view->set('admin', true);
            $this->_view->set('admin_button', 'product');
        }
    }
}
