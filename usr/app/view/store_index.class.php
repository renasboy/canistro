<?php
namespace app\view;

class store_index extends \app\view {

    protected $_top = 'store_full';

    protected $_view = 'store_index';

    protected $_subs = [
        'store_checkout'    => null
    ];

    protected $_css = [];

    protected $_js = [
        '/js/store_index.js'
    ];

    public function execute () {
    }
}
