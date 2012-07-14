<?php
namespace app\controller;

class store_checkout extends \app\simple_controller {

    protected $_dependencies        = [
        'mailer'        => null
    ];

    protected $_default_input   = [
        'name'                  => null,
        'email'                 => null,
        'address'               => null,
        'comments'              => null
    ];

    protected function _validate_input () {
        $this->_validator->validate('is_entity', 'store', 'name', $this->_input['name']);
        if ($this->_validator->error()) {
            $this->_error->not_found('store: ' . $this->_input['name']);
        }

        if ($this->_request->method() != 'post') {
            $this->_error->bad_request('checkout without POST');
        }

        $cart = $this->_session->get($this->_input['name'], 'cart');
        if (!$cart) {
            $this->_error->precondition_failed('checkout missing cart');
        }

        $this->_validator->validate('is_email', $this->_input['email']);
        if ($this->_input['address']) {
            $this->_validator->validate('is_text',  $this->_input['address']);
        }

        if ($this->_input['comments']) {
            $this->_validator->validate('is_text',  $this->_input['comments']);
        }

        if ($this->_validator->error()) {
            $this->_error->bad_request('checkout: ' . $this->_validator->error());
        }
    }

    protected function _execute () {

        $cart = $this->_session->get($this->_input['name'], 'cart');

        $input          = [
            'store'     => $this->_input['name'],
            'status'    => 'pre',
            'email'     => $this->_input['email'],
            'address'   => $this->_input['address'],
            'comments'  => $this->_input['comments']
        ];
        
        $shop_id = $this->_api_client->save('/shop/null', $input);

        if (!$shop_id) {
            $this->_error->internal_server_error('save shop with data: ' . print_r($input, true));
        }

        $subtotal   = 0;
        $total      = 0;
        $loop       = 1;
        $count      = count($cart);
        $products   = [];

        foreach ($cart as $product_id => $quantity) {

            $product    = $this->_api_client->get('/product/' . $product_id, [])[0];

            if (!$product) {
                $this->_error->internal_server_error('get product for shop with id: ' . $product_id);
            }

            $input['product_id']    = [
                'product_id'        => $product->id,
                'quantity'          => $quantity,
                'price'             => $product->price
            ];

            $subtotal   = $product->price * $quantity;
            $total      += $subtotal;
            
            // last loop
            if ($loop++ == $count) {
                $input['total']     = $total;
            }

            $result = $this->_api_client->save('/shop/' . $shop_id, $input);

            if (!$result) {
                $this->_error->internal_server_error('save product to shop with data: ' . print_r($input, true));
            }

            // data for mail template
            $product->quantity  = $quantity;
            $product->subtotal  = number_format($subtotal, 2);
            $products[]         = $product;
        }

        // SUCCESS, compose the mail for confirmation and die successfully :-)
        $this->_view->set('email',      $this->_input['email']);
        $this->_view->set('name',       $this->_input['name']);
        $this->_view->set('products',   $products);
        $this->_view->set('shop_id',    $shop_id);
        $this->_view->set('total',      number_format($total));
        $this->_view->set('token',      md5(crypt(sprintf('%s|%s|%d|%d', $this->_input['email'], $this->_input['name'], $shop_id, intval($total)), 'CO')));
        $message = $this->_view->mail('mail_store_shop_confirm');
        $this->_logger->debug(sprintf('STORE SHOP MAIL CONFIRM: %s', $message));

        $mailer = $this->_dependencies['mailer'];
        $mailer->send($this->_input['email'], 'Your order at ' . $this->_input['name'], $message, $this->_conf->get('mail_from'));

        // clean cart
        $this->_session->set($this->_input['name'], 'cart', []);

        // ufs success !!!
        die('success');
    }
}
