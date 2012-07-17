<?php
namespace app\view;

class website_browse extends \app\view {

    protected $_view = 'website_browse';

    protected $_subs = [];

    protected $_css = [];

    protected $_js = [];

    public function execute () {

        $input              = [
            'products'      => true,
            'offset_start'  => 0,
            'offset_end'    => 30
        ];

        $stores      = $this->_api_client->get('/store', $input);

        $this->set('stores', $stores);

        $this->_helper->set_metas([
            'title'         => $this->_language->get('browse.meta_title'),
            'description'   => $this->_language->get('browse.meta_description'),
            'keywords'      => $this->_language->get('browse.meta_keywords') 
        ]);
    }
}
