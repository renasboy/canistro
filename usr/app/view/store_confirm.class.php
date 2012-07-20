<?php
namespace app\view;

class store_confirm extends \app\view {

    protected $_top = 'store_full';

    protected $_view = 'store_confirm';

    protected $_subs = [];

    protected $_css = [];

    protected $_js = [];

    public function execute () {
        $this->_helper->set_metas([
            'title'         => sprintf($this->_language->get('store_confirm.meta_title'), $this->get('store_name')),
            'description'   => sprintf($this->_language->get('store_confirm.meta_description'), $this->get('store_name')),
            'keywords'      => str_replace('%s', $this->get('store_name'), $this->_language->get('store_confirm.meta_keywords'))
        ]);
    }
}
