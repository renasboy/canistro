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
            'title'         => $this->_language->get('index.meta_title'),
            'description'   => $this->_language->get('index.meta_description'),
            'keywords'      => $this->_language->get('index.meta_keywords') 
        ]);
    }
}
