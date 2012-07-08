<?php
namespace app\view;

class website_about extends \app\view {

    protected $_view = 'website_about';

    protected $_subs = [];

    protected $_css = [];

    protected $_js = [];

    public function execute () {
        $this->_helper->set_metas([
            'title'         => 'canistro about | canistro, your personal e-commerce.',
            'description'   => 'What is canistro? Why everyone is using it? How can I use it?',
            'keywords'      => 'about, about canistro, what is canistro, why canistro, how canistro, questions, answers, faq, canistro faq, canistro history, canistro team, canistro, personal e-commerce, personal shop, personal webshop, personal e-comm, shop, webshop, e-commerce, e-comm, personal, sell, buy, selling, buying, seller, buyer, sale, free, gratis, open source, renasboy, linux for me, linuxforme, canistro linux for me'
        ]);
    }
}
