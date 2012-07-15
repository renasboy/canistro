<?php
namespace app\controller;

class store_product extends \app\simple_controller {

    protected $_default_input   = [
        'id'                    => null,
        'store_name'            => null,
        'img'                   => null,
        'name'                  => null,
        'price'                 => null,
        'description'           => null,
    ];

    protected function _validate_input () {

        $this->_validator->validate('is_entity', 'store', 'name', $this->_input['store_name']);
        if ($this->_validator->error()) {
            $this->_error->not_found('store: ' . $this->_input['store_name']);
        }
        
        // check authentication
        $auth_store = $this->_session->get('auth', 'store'); 
        
        if (!$auth_store || $auth_store->name != $this->_input['store_name']) {
            $this->_error->unauthorized('product at store: ' . $this->_input['store_name']);
        }

        if ($this->_request->method() != 'post') {
            $this->_error->bad_request('product without POST');
        }

        $this->_validator->validate('is_img_file',  $this->_conf->get('image_root') . '/' . $this->_input['img']);
        $this->_validator->validate('is_text',      $this->_input['name']);
        $this->_validator->validate('is_number',    $this->_input['price']);
        if ($this->_input['description']) {
            $this->_validator->validate('is_text',  $this->_input['description']);
        }

        if ($this->_input['id']) {
            $this->_validator->validate('is_entity', 'product', 'id', $this->_input['id'], [ 'store' => $this->_input['store_name']]);
        }
        else {
            // this null is a string, used to compose the resource url
            $this->_input['id'] = 'null';
        }

        if ($this->_validator->error()) {
            $this->_error->bad_request('product: ' . $this->_validator->error());
        }
    }

    protected function _execute () {

        $auth_store = $this->_session->get('auth', 'store');

        // this is the actual upload
        $tmp_img    = $this->_conf->get('image_root') . '/' . $this->_input['img'];
        $ext        = str_replace('image/', null, mime_content_type($tmp_img));
        $img        = sprintf('product/%s-from-%s-%d.%s', $this->_validator->seo($this->_input['name']), $auth_store->name, $this->_request->time(), $ext);
        $new_img    = $this->_conf->get('image_root') . '/' . $img;
        if (!rename($tmp_img, $new_img)) {
            $this->_error->internal_server_error('rename image: ' . print_r($this->_input['img'], true));
        }

        $input              = [
            'store'         => $auth_store->name,
            'img'           => $img,
            'name'          => $this->_input['name'],
            'price'         => $this->_input['price'],
            'description'   => $this->_input['description']
        ];

        $product_id = $this->_api_client->save('/product/' . $this->_input['id'], $input);

        if (!$product_id) {
            $this->_error->internal_server_error('save product with data: ' . print_r($input, true));
        }

        die('success');
    }
}
