<?php
namespace app\view;

class store_about extends \app\view {

    protected $_top = 'store_full';

    protected $_view = 'store_about';

    protected $_subs = [];

    protected $_css = [
        '/css/bootstrap-wysihtml5.css'
    ];

    protected $_js = [
        '/js/wysihtml5.js',
        '/js/bootstrap-wysihtml5.js',
        '/js/store_about.js'
    ];

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
            'title'         => sprintf('about %s @ canistro | canistro, your personal e-commerce.', $store->name),
            'description'   => sprintf('What is %s? Why everyone is using %s? How can I use %s?', $store->name, $store->name, $store->name),
            'keywords'      => str_replace('%s', $store->name, 'about, about %s, what is %s, why %s, how %s, questions, answers, faq, %s faq, %s history, %s team, %s, shop, webshop, e-commerce, e-comm, personal, sell, buy, selling, buying, seller, buyer, sale, free, gratis, open source, renasboy, linux for me, linuxforme, canistro linux for me')
        ]);
    }
}
