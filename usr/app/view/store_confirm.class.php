<?php
namespace app\view;

class store_confirm extends \app\view {

    protected $_top = 'store_full';

    protected $_view = 'store_confirm';

    protected $_subs = [];

    protected $_css = [];

    protected $_js = [];

    public function execute () {
        $this->_helper->set_metas([
            'title'         => sprintf('confirm order at %s @ canistro | canistro, your personal e-commerce.', $this->get('store_name')),
            'description'   => sprintf('Confirmation page at %s.', $this->get('store_name')),
            'keywords'      => str_replace('%s', $this->get('store_name'), 'confirm, confirm %s, shop, webshop, e-commerce, e-comm, personal, sell, buy, selling, buying, seller, buyer, sale, free, gratis, open source, renasboy, linux for me, linuxforme, canistro linux for me')
        ]);
    }
}
