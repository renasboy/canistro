<?php
namespace app\view;

class store_index extends \app\view {

    protected $_top = 'store_full';

    protected $_view = 'store_index';

    protected $_subs = [
        'store_checkout'    => null,
        'store_product'     => null
    ];

    protected $_css = [
        '/css/store_index.css'
    ];

    protected $_js = [
        '/js/store_index.js'
    ];

    public function execute () {
        $input              = [
            'products'      => true,
            'name'          => $this->get('store_name'),
            'offset_start'  => 0,
            'offset_end'    => 1
        ];

        $store      = $this->_api_client->get('/store', $input)[0];

        if (!$store) {
            $this->_error->not_implemented('store: ' . $this->get('store_name'));
        }

        // if case of admin get all products
        if ($this->get('admin')) {
            $input          = [
                'store'     => $this->get('store_name') ,
                'active'    => [0, 1]
            ];
            $store->products = $this->_api_client->get('/product', $input);
        }

        $this->set('store', $store);

        
        if (!empty($store->about)) {
            $description    = str_replace(chr(10), ' ', strip_tags($store->about));
            $pos            = strpos($description, '.');
            if ($pos !== FALSE) {
                $description    = substr($description, 0, $pos);
            }
        }
        else {
            $description = sprintf($this->_language->get('store_index.meta_description'), $store->name);
        }

        $this->_helper->set_metas([
            'title'         => sprintf($this->_language->get('store_index.meta_title'), $store->name),
            'description'   => $description,
            'keywords'      => $store->name . ', ' . $this->_language->get('store_index.meta_keywords') 
        ]);
    }
}
