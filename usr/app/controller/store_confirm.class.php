<?php
namespace app\controller;

class store_confirm extends \app\simple_controller {

    protected $_dependencies    = [
        'mailer'                => null
    ];

    protected $_default_input   = [
        'name'                  => null,
        'id'                    => null,
        'token'                 => null
    ];

    protected function _validate_input () {
        $this->_validator->validate('is_entity', 'store', 'name', $this->_input['name']);
        if ($this->_validator->error()) {
            $this->_error->not_found('store: ' . $this->_input['name']);
        }

        $this->_validator->validate('is_entity', 'shop', 'id', $this->_input['id']);
        if ($this->_validator->error()) {
            $this->_error->not_found('shop: ' . $this->_input['id']);
        }

        $this->_validator->validate('is_text', $this->_input['token']);

        if ($this->_validator->error()) {
            $this->_error->bad_request('store confirm: ' . $this->_validator->error());
        }
    }

    protected function _execute () {
        $this->_view->set('store_name', $this->_input['name']);
        
        $shop = $this->_api_client->get('/shop/' . $this->_input['id'], [])[0];

        $token = md5(crypt(sprintf('%s|%s|%d|%d', $shop->email, $this->_input['name'], $shop->id, intval($shop->total)), 'CO'));

        if ($token != $this->_input['token']) {
            $this->_error->bad_request('store token: ' . $this->_validator->error());
        }
        
        $result = $this->_api_client->save('/shop/' . $shop->id, ['status' => 'ordered']);
        
        if (!$result) {
            $this->_error->internal_server_error('save shop status as ordered for: ' . $shop->id);
        }

        // get store to send email
        $input              = [
            'name'          => $this->_input['name'],
            'offset_start'  => 0,
            'offset_end'    => 1
        ];
        $store      = $this->_api_client->get('/store', $input)[0];
        if (!$store) {
            $this->_error->internal_server_error('get store for confirm: ' . print_r($input, true));
        }

        // SUCCESS, compose the mail for confirmation and redirect
        $this->_view->set('name',       $store->name);
        $message = $this->_view->mail('mail_store_shop');
        $this->_logger->debug(sprintf('STORE SHOP MAIL: %s', $message));

        $mailer = $this->_dependencies['mailer'];
        $mailer->send($store->email, 'An order at ' . $store->name, $message, $this->_conf->get('mail_from'));
    }
}
