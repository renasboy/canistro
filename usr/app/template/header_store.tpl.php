    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="brand" href="/<?php print $store_name; ?>"><?php print $store_name; ?></a>

                <ul class="nav">
                    <li class="home visible-desktop"><a href="/<?php print $store_name; ?>"><?php print $lang->get('global.menu_home'); ?></a></li>
                    <li class="about"><a href="/<?php print $store_name; ?>/about"><?php print $lang->get('global.menu_about'); ?></a></li>
                    <li class="info"><a href="/<?php print $store_name; ?>/payment-and-delivery"><?php print $lang->get('global.menu_info'); ?></a></li>
                    <li class="contact"><a href="/<?php print $store_name; ?>/contact"><?php print $lang->get('global.menu_contact'); ?></a></li>
                </ul>

                <!-- cart is here -->
                <ul class="nav pull-right">
                    <li class="divider-vertical"></li>
                    <li class="cart-total"><a>&euro;0.00</a></li>
                    <li class="divider-vertical"></li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-shopping-cart icon-white"></i> <span class="label label-success">0</span> <?php print $lang->get('global.menu_cart'); ?><b class="caret"></b></a>
                        <div class="dropdown-menu span4">
                            <h3><?php print $lang->get('global.menu_cart_empty'); ?></h3>
                        </div>
                    </li>
                </ul>

            </div>
        </div>
    </div>
