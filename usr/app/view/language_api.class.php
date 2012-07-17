<?php
namespace app\view;

class language_api extends \app\view {

    protected $_top     = 'none';

    protected $_view    = 'language_api';

    protected $_subs    = [
    ];

    protected $_css     = [
    ];

    protected $_js      = [
    ];

    public function execute () {
        $language = $this->_language->get($this->get('section'), false);
        $this->set('language', $language);
    }
}
