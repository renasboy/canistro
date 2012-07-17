<?php
namespace app\view;

class website_contact extends \app\view {

    protected $_view = 'website_contact';

    protected $_subs = [];

    protected $_css = [];

    protected $_js = [];

    public function execute () {
        $this->_helper->set_metas([
            'title'         => $this->_language->get('contact.meta_title'),
            'description'   => $this->_language->get('contact.meta_description'),
            'keywords'      => $this->_language->get('contact.meta_keywords') 
        ]);
    }
}
