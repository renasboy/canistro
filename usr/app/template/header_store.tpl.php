    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="brand" href="/<?php print $store_name; ?>"><?php print $store_name; ?></a>

                <ul class="nav">
                    <li class="home visible-desktop"><a href="/<?php print $store_name; ?>">Home</a></li>
                    <li class="about"><a href="/<?php print $store_name; ?>/about">About</a></li>
                    <li class="info"><a href="/<?php print $store_name; ?>/payment-and-delivery">Payment &amp; delivery</a></li>
                    <li class="contact"><a href="/<?php print $store_name; ?>/contact">Contact</a></li>
                </ul>

                <ul class="nav pull-right">
                    <li class="divider-vertical"></li>
                    <li class="cart-total"><a>&euro;40.00</a></li>
                    <li class="divider-vertical"></li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-shopping-cart icon-white"></i> <span class="label label-success">5</span> My Cart<b class="caret"></b></a>
                        <div class="dropdown-menu span4">
                            <table class="table table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>product name</th>
                                        <th>price</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>2</td>
                                        <td><a href="">product with really long name #1</a></td>
                                        <td>&euro;20.00</td>
                                        <td><a href="#"><i class="icon-trash"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><a href="">product #1</a></td>
                                        <td>&euro;20.00</td>
                                        <td><a href="#"><i class="icon-trash"></i></a></td>
                                    </tr>

                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>TOTAL</td>
                                        <td>&euro;40.00</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><a class="btn-success btn-large btn pull-right" data-target="#modal-form" href="#modal-form" data-toggle="modal"><i class="icon-ok icon-white"></i> CHECKOUT</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </li>
                </ul>

            </div>
        </div>
    </div>
