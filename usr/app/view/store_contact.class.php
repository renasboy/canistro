<?php
namespace app\view;

class store_contact extends \app\view {

    protected $_top = 'store_full';

    protected $_view = 'store_contact';

    protected $_subs = [];

    protected $_css = [
        '/css/bootstrap-wysihtml5.css'
    ];

    protected $_js = [
        '/js/wysihtml5.js',
        '/js/bootstrap-wysihtml5.js',
        '/js/store_contact.js'
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
            'title'         => sprintf($this->_language->get('store_contact.meta_title'), $store->name),
            'description'   => sprintf($this->_language->get('store_contact.meta_description'), $store->name),
            'keywords'      => str_replace('%s', $store->name, $this->_language->get('store_contact.meta_keywords'))
        ]);
    }
}
