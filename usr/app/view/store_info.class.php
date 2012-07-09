<?php
namespace app\view;

class store_info extends \app\view {

    protected $_top = 'store_full';

    protected $_view = 'store_info';

    protected $_subs = [];

    protected $_css = [];

    protected $_js = [];

    public function execute () {
        $input              = [
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
            'title'         => sprintf('payment and delivery by %s @ canistro | canistro, your personal e-commerce.', $store->name),
            'description'   => sprintf('How to pay and ship your order from %s.', $store->name),
            'keywords'      => str_replace('%s', $store->name, 'payment %s, delivery %s, payment, delivery, ship, shipment, conditions, canistro, personal e-commerce, personal shop, personal webshop, personal e-comm, shop, webshop, e-commerce, e-comm, personal, sell, buy, selling, buying, seller, buyer, sale, free, gratis, open source, renasboy, linux for me, linuxforme, canistro linux for me')
        ]);
    }
}
