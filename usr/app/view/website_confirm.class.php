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
            'title'         => $this->_language->get('confirm.meta_title'),
            'description'   => $this->_language->get('confirm.meta_description'),
            'keywords'      => $this->_language->get('confirm.meta_keywords') 
        ]);
    }
}
