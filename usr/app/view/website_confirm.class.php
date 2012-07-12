<?php
namespace app\view;

class website_confirm extends \app\view {

    protected $_top = 'full';

    protected $_view = 'website_confirm';

    protected $_subs = [];

    protected $_css = [];

    protected $_js = [];

    public function execute () {
        $this->_helper->set_metas([
            'title'         => 'confirm registration @ canistro | canistro, your personal e-commerce.',
            'description'   => 'Confirmation page',
            'keywords'      => 'confirm, confirm, shop, webshop, e-commerce, e-comm, personal, sell, buy, selling, buying, seller, buyer, sale, free, gratis, open source, renasboy, linux for me, linuxforme, canistro linux for me'
        ]);
    }
}
