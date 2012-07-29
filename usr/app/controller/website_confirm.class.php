<?php
namespace app\controller;

class website_confirm extends \app\simple_controller {

    protected $_default_input   = [
        'id'                    => null,
        'token'                 => null
    ];

    protected function _validate_input () {
        $this->_validator->validate('is_entity', 'store', 'id', $this->_input['id']);
        $this->_validator->validate('is_text', $this->_input['token']);

        if ($this->_validator->error()) {
            $this->_error->bad_request('website confirm: ' . $this->_validator->error());
        }
    }

    protected function _execute () {
        $store = $this->_api_client->get('/store/' . $this->_input['id'], [])[0];

        // already active, page should not exist
        if (!empty($store->active)) {
            $this->_error->not_found('website already confirmed: ' . $store->name);
        }

        $token = md5(crypt(sprintf('%s|%s|%d', $store->email, $store->name, $store->id), 'CO'));

        if ($token != $this->_input['token']) {
            $this->_error->bad_request('website token: ' . $this->_validator->error());
        }
        
        $result = $this->_api_client->save('/store/' . $store->id, ['active' => 1]);
        
        if (!$result) {
            $this->_error->internal_server_error('save store status to active: ' . $store->id);
        }

        $this->_session->set('auth', 'store', $store);
        $this->_view->set('store_name', $store->name);
    }
}
