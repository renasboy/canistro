<?php
namespace app\controller;

class website_index extends \app\simple_controller {

    protected $_dependencies    = [
        'mailer'                => null
    ];

    protected $_default_input   = [
        'name'                  => null,
        'email'                 => null
    ];

    protected function _validate_input () {
        if ($this->_request->method() == 'post') {
            $this->_validator->validate('is_match',     $this->_input['name'], '^([A-Za-z0-9_-]{5,30})$' );
            $this->_validator->validate('is_email',     $this->_input['email']);
            $this->_validator->validate('is_not_entity', 'store', 'name', $this->_input['name']);
            $this->_validator->validate('is_not_entity', 'store', 'email', $this->_input['email']);

            if ($this->_validator->error()) {
                $this->_error->bad_request('signup: ' . $this->_validator->error());
            }
        }
    }

    protected function _execute () {
        if ($this->_request->method() == 'post') {
            $input          = [
                'name'      => $this->_input['name'],
                'email'     => $this->_input['email'],
                'active'    => 'false' // string false not boolean
            ];
            $store_id = $this->_api_client->save('/store/null', $input);

            // SUCCESS, create hash store in the session, compose the mail 
            // for confirmation with token and die successfully :-)
            $this->_view->set('email',      $this->_input['email']);
            $this->_view->set('name',       $this->_input['name']);
            $this->_view->set('store_id',   $store_id);
            $this->_view->set('token',      md5(crypt(sprintf('%s|%s|%d', $this->_input['email'], $this->_input['name'], $store_id), 'CO')));
            $message = $this->_view->mail('mail_website_confirm');
            $this->_logger->debug(sprintf('WEBSITE MAIL CONFIRM: %s', $message));

            $mailer = $this->_dependencies['mailer'];
            $mailer->send($this->_input['email'], 'Your ' . $this->_input['name'] . ' store at canistro.', $message, $this->_conf->get('mail_from'));

            // ufs success !!!
            die('success');
        }
    }
}
