<?php
namespace app\view;

class error_message extends \app\view {

    protected $_view = 'error_message';

    protected $_subs = [];

    protected $_css = [];

    protected $_js = [];

    public function execute () {
        // TODO if 404 try to resolve it getting some content
        switch ($this->get('code')) {
            case 400:
                $this->set('title', 'Request is not proper');
                $this->set('description', 'The request you are placing is not correct, please verify the source of the request otherwise try our homepage.');
            break;

            case 404:
                $this->set('title', 'Page not found');
                $this->set('description', 'The page you are looking for is not found in this server, please check the address and try again.<br>If the address seems correct then it is possible that the page has moved.');
            break;

            case 501:
                $this->set('title', 'This was not implemented yet');
                $this->set('description', 'The page you are looking for exists but it was not implemented yet. try again later.<br>If the problem persists contact our development team.');
            break;

            case 500:
                $this->set('title', 'An internal server error');
                $this->set('description', 'There was an internal server error, do not worry, you did not do anything wrong.<br>We are the ones with problem, please try again, if it persists contact our development team');
            break;

            default:
                $this->set('title', 'Unknown error ' . $this->get('code'));
                $this->set('description', 'An unknown error occured please try again and if the problem persists contact our development team.');
            break;
        }

        $this->_helper->set_metas([
            'title'         => $this->get('title'),
            'description'   => strip_tags($this->get('description')),
            'keywords'      => 'error ' .  $this->get('code') . ', canistro, personal e-commerce, personal shop, personal webshop, personal e-comm, shop, webshop, e-commerce, e-comm, deal, deals, sell, buy, selling, buying, seller, buyer, sale, open source, renasboy, linux for me, linuxforme, canistro linux for me' 
        ]);

    }
}
