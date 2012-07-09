<?php
namespace app\view;

class store_contact extends \app\view {

    protected $_top = 'store_full';

    protected $_view = 'store_contact';

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
            'title'         => sprintf('contact %s @ canistro | canistro, your personal e-commerce.', $store->name),
            'description'   => sprintf('Contact the %s team via online chat or email.', $store->name),
            'keywords'      => str_replace('%s', $store->name, 'contact %s, contact, online chat, chat, email, contact us, chat with us, chat with the team, contact team, contact %s, team, canistro, personal e-commerce, personal shop, personal webshop, personal e-comm, shop, webshop, e-commerce, e-comm, personal, sell, buy, selling, buying, seller, buyer, sale, free, gratis, open source, renasboy, linux for me, linuxforme, canistro linux for me')
        ]);
    }
}
