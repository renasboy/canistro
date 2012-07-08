<?php
namespace app\view;

class website_browse extends \app\view {

    protected $_view = 'website_browse';

    protected $_subs = [];

    protected $_css = [];

    protected $_js = [];

    public function execute () {
        $this->_helper->set_metas([
            'title'         => 'browse all stores in canistro | canistro, your personal e-commerce.',
            'description'   => 'Browse all stores and products inside the canistro collection.',
            'keywords'      => 'browse, browse stores, browse products, browse collection, browse shops, find, search, discover, look for, canistro stores, canistro shops, canistros, canistro products, canistro, personal e-commerce, personal shop, personal webshop, personal e-comm, shop, webshop, e-commerce, e-comm, personal, sell, buy, selling, buying, seller, buyer, sale, free, gratis, open source, renasboy, linux for me, linuxforme, canistro linux for me'
        ]);
    }
}
