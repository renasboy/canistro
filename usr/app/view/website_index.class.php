<?php
namespace app\view;

class website_index extends \app\view {

    protected $_view = 'website_index';

    protected $_subs = [
        'website_signup'    => null
    ];

    protected $_css = [
        '/css/website_index.css'
    ];

    protected $_js = [
        '/js/website_index.js'
    ];

    public function execute () {
        // highlight is hardcoded for now
        $input  = [
            'products'      => true,
            'name'          => 'groo-o-errante-colecao',
            'offset_start'  => 0,
            'offset_end'    => 1
        ];
        $highlight  = $this->_api_client->get('/store', $input)[0];
        $this->set('highlight', $highlight);
        
        $this->_helper->set_metas([
            'title'         => 'canistro, your personal e-commerce.',
            'description'   => 'With canistro you can easily publish your products and have them avaible worldwide in matter of seconds. Canistro is completely free up until 30 products and you can have as many canistros as you like. ',
            'keywords'      => 'canistro, personal e-commerce, personal shop, personal webshop, personal e-comm, shop, webshop, e-commerce, e-comm, micro shop, micro e-commerce, micro e-comm, micro webshop, personal, deal, deals, sell, buy, selling, buying, seller, buyer, sale, free, gratis, open source, renasboy, linux for me, linuxforme, canistro linux for me'
        ]);
    }
}
