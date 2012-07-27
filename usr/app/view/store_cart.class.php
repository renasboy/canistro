<?php
namespace app\view;

class store_cart extends \app\view {

    protected $_top = 'none';

    protected $_view = 'store_cart';

    protected $_subs = [];

    protected $_css = [];

    protected $_js = [];

    public function execute () {
        $cart               = $this->get('cart');
        if (!$cart) {
            $this->set('cart', null);
            return;
        }

        $input              = [
            'id'            => array_keys($cart),
            'offset_start'  => 0,
            'offset_end'    => 30
        ];

        $products   = $this->_api_client->get('/product', $input);

        $total      = 0;
        $total_qty  = 0;
        foreach ($products as $key => $product) {
            $products[$key]->quantity   = $cart[$product->id];
            $products[$key]->subtotal   = $product->price * $cart[$product->id];
            $products[$key]->price      = number_format($products[$key]->price, 2, ',', '.');
            $total_qty                  += $products[$key]->quantity;
            $total                      += $products[$key]->subtotal;
        }
        $this->set('cart', [ 'products' => $products, 'quantity' => $total_qty, 'total' => number_format($total, 2, ',', '.') ]);
    }
}
