<?php
namespace app\view;

class store_index extends \app\view {

    protected $_top = 'store_full';

    protected $_view = 'store_index';

    protected $_subs = [
        'store_checkout'    => null
    ];

    protected $_css = [];

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

        $this->set('store', $store);

        $this->_helper->set_metas([
            'title'         => sprintf('%s @ canistro | canistro, your personal e-commerce.', $store->name),
            'description'   => !empty($store->about) ? $store->about : sprintf('This is the %s store at canistro online, your personal e-commerce.', $store->name),
            'keywords'      => $store->name . ', canistro, personal e-commerce, personal shop, personal webshop, personal e-comm, shop, webshop, e-commerce, e-comm, deal, deals, sell, buy, selling, buying, seller, buyer, sale, open source, renasboy, linux for me, linuxforme, canistro linux for me' 
        ]);
    }
}
