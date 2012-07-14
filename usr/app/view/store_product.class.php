<?php
namespace app\view;

class store_product extends \app\view {

    protected $_top = 'store_full';

    protected $_view = 'store_product';

    protected $_subs = [];

    protected $_css = [];

    protected $_js = [
        '/js/plupload.js',
        '/js/plupload.html5.js'
    ];

    public function execute () {
    }
}
