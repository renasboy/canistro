<?php
namespace app\controller;

class store_about extends \app\simple_controller {

    protected $_default_input   = [
        'name'                  => null,
        'about'                 => null
    ];

    protected function _validate_input () {
        $this->_validator->validate('is_entity', 'store', 'name', $this->_input['name']);
        if ($this->_validator->error()) {
            $this->_error->not_found('store: ' . $this->_input['name']);
        }

        // if updating
        if ($this->_request->method() == 'post') {
            
            // check authentication
            $auth_store = $this->_session->get('auth', 'store'); 
            
            if (!$auth_store || $auth_store->name != $this->_input['name']) {
                $this->_error->unauthorized('product at store: ' . $this->_input['name']);
            }

            $this->_validator->validate('is_html',  $this->_input['about']);

            if ($this->_validator->error()) {
                $this->_error->bad_request('about: ' . $this->_validator->error());
            }
        }
    }

    protected function _execute () {
        $this->_view->set('store_name', $this->_input['name']);

        $auth_store = $this->_session->get('auth', 'store'); 
        
        if ($auth_store && $auth_store->name == $this->_input['name']) {
            $this->_view->set('admin', true);
        }

        if ($this->_request->method() == 'post') {
            $result = $this->_api_client->save('/store/' . $auth_store->id, ['about' => $this->_input['about']]);
            if (!$result) {
                $this->_error->internal_server_error('save store about: ' . $auth_store->id . ' and about :' . $this->_input['about']);
            }
            die('success');
        }
    }
}
