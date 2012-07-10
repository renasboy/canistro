<?php
namespace app\controller;

class store_cart extends \app\simple_controller {

    protected $_default_input   = [
        'name'                  => null,
        'action'                => null,
        'id'                    => null
    ];

    protected function _validate_input () {

        if ($this->_request->method() != 'post') {
            $this->_error->bad_request('cart without POST');
        }

        $this->_validator->validate('is_in_list', $this->_input['action'], ['add','del','get']);
        $this->_validator->validate('is_entity', 'store', 'name', $this->_input['name']);
        if ($this->_input['action'] != 'get') {
            $this->_validator->validate('is_entity', 'product', 'id', $this->_input['id']);
        }

        if ($this->_validator->error()) {
            $this->_error->bad_request('cart: ' . $this->_validator->error());
        }
    }

    protected function _execute () {
        $cart = $this->_session->get($this->_input['name'], 'cart');

        if ($cart === null) {
            $cart = [];
        }

        switch ($this->_input['action']) {

            case 'add':
                if (!array_key_exists($this->_input['id'], $cart)) {
                    $cart[$this->_input['id']] = 0;
                }
                $cart[$this->_input['id']]++;
            break;

            case 'del':
                if (array_key_exists($this->_input['id'], $cart)) {
                    $cart[$this->_input['id']]--;

                    if ($cart[$this->_input['id']] == 0) {
                        unset($cart[$this->_input['id']]);
                    }
                }
            break;
        }
        $this->_session->set($this->_input['name'], 'cart', $cart);
        $this->_view->set('cart', $cart);
    }
}
