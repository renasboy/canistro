<?php
namespace app\view;

class top_store_full extends \app\view {

    protected $_view     = 'top_store_full';

    protected $_subs    = [
        'header_store'  => null,
        'footer'        => null
    ];

    protected $_js = [
        '/js/jquery.js',
        '/js/jquery.validate.js',
        '/js/bootstrap.min.js'
    ];

    protected $_css = [
        '/css/bootstrap.min.css',
        '/css/default_store.css',
        '/css/bootstrap-responsive.min.css'
    ];

    public function execute () {
        $all_css    = $this->css();
        if ($this->_conf->get('css_cache')) {
            $all_css   = [ $this->_helper->pack_css($all_css) ];
        }
        $this->set('css',   $all_css);

        $all_js     = $this->js();
        if ($this->_conf->get('js_cache')) {
            $all_js   = [ $this->_helper->pack_js($all_js) ] ;
        }
        $this->set('js',    $all_js);
    }
}
