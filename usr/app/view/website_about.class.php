<?php
namespace app\view;

class website_about extends \app\view {

    protected $_view = 'website_about';

    protected $_subs = [];

    protected $_css = [];

    protected $_js = [];

    public function execute () {
        $this->_helper->set_metas([
            'title'         => $this->_language->get('about.meta_title'),
            'description'   => $this->_language->get('about.meta_description'),
            'keywords'      => $this->_language->get('about.meta_keywords') 
        ]);
    }
}
