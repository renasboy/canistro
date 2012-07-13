<?php
namespace app\controller;

class website_signin extends \app\simple_controller {

    protected $_dependencies    = [
        'mailer'                => null
    ];

    protected $_default_input   = [
        'username'              => null,
        'token'                 => null
    ];

    protected function _validate_input () {
        if ($this->_request->method() == 'post') {
            $this->_validator->validate('is_text',     $this->_input['username']);

            if ($this->_validator->error()) {
                $this->_error->bad_request('signin: ' . $this->_validator->error());
            }
        }
        else {
            $passwd = $this->_session->get('auth', 'tmp.passwd');
            $store  = $this->_session->get('auth', 'tmp.store');
            $time   = $this->_session->get('auth', 'tmp.time');

            $this->_validator->validate('is_number',    $passwd);
            $this->_validator->validate('is_entity',    'store', 'id', $store);
            $this->_validator->validate('is_number',    $time);
            if ($this->_validator->error()) {
                $this->_error->precondition_failed('session data for signin');
            }

            $this->_validator->validate('is_text',      $this->_input['token']);
            if ($this->_validator->error()) {
                $this->_error->bad_request('signin token: ' . $this->_validator->error());
            }
        }
    }

    protected function _execute () {

        $this->_session->del('auth', 'store');

        if ($this->_request->method() == 'post') {
            $input = [
                'name'          => $this->_input['username'],
                'offset_start'  => 0,
                'offset_end'    => 1,
            ];

            $store = $this->_api_client->get('/store', $input);

            if (!$store) {
                $input = [
                    'email'         => $this->_input['username'],
                    'offset_start'  => 0,
                    'offset_end'    => 1,
                ];

                $store = $this->_api_client->get('/store', $input);
            }

            if (!$store) {
                $this->_error->unauthorized('signin request: ' . $this->_input['username']);
            }

            if (is_array($store)) {
                $store = $store[0];
            }

            // SUCCESS, create hash store in the session, compose the mail 
            // for confirmation with token and die successfully :-)
            $passwd = mt_rand();
            $this->_session->set('auth', 'tmp.passwd', $passwd);
            $this->_session->set('auth', 'tmp.store',  $store->id);
            $this->_session->set('auth', 'tmp.time',   $this->_request->time());

            $this->_view->set('email',      $store->email);
            $this->_view->set('name',       $store->name);

            $key    = crypt($passwd . $this->_request->time(), '$6$rounds=5000$thisisthesaltforcanistro$');
            $hash   = sprintf('%s|%s|%d|%s', $store->email, $store->name, $store->id, $key);
            $this->_view->set('token', md5($hash));
            $message = $this->_view->mail('mail_signin');
            $this->_logger->debug(sprintf('WEBSITE MAIL SIGNIN: %s', $message));

            $mailer = $this->_dependencies['mailer'];
            $mailer->send($store->email, 'Sign in at ' . $store->name . ' store on canistro.', $message, $this->_conf->get('mail_from'));

            die('success');
        }
        else {
            $passwd = $this->_session->get('auth', 'tmp.passwd');
            $id     = $this->_session->get('auth', 'tmp.store');
            $time   = $this->_session->get('auth', 'tmp.time');

            $store  = $this->_api_client->get('/store/' . $id, [])[0];

            $key    = crypt($passwd . $time, '$6$rounds=5000$thisisthesaltforcanistro$');
            $hash   = sprintf('%s|%s|%d|%s', $store->email, $store->name, $store->id, $key);
            $token  = md5($hash);

            if ($token != $this->_input['token'] || $time < $this->_request->time() - 1800) { // 30 min
                $this->_error->unauthorized('signin auth: ' . $id);
            }

            $this->_session->del('auth', 'tmp.passwd');
            $this->_session->del('auth', 'tmp.store');
            $this->_session->del('auth', 'tmp.time');

            $this->_session->set('auth', 'store', $store);
            $this->_request->redirect('/' . $store->name);
        }
    }
}
