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

                <?php if (!empty($show_cart)) { ?>
                <ul class="nav pull-right">

                    <?php if (!empty($admin)) { ?>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-tag icon-white"></i> <?php print $lang->get('global.menu_currency'); ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="/<?php print $store_name; ?>/currency/EUR">Euro (&euro;)</a></li>
                            <li><a href="/<?php print $store_name; ?>/currency/USD">Dollar ($)</a></li>
                            <li><a href="/<?php print $store_name; ?>/currency/GBP">Pounds (&pound;)</a></li>
                            <li><a href="/<?php print $store_name; ?>/currency/CAD">Canadian Dollar ($)</a></li>
                            <li><a href="/<?php print $store_name; ?>/currency/AUD">Australian Dollar ($)</a></li>
                            <li><a href="/<?php print $store_name; ?>/currency/BRL">Real (R$)</a></li>
                            <li><a href="/<?php print $store_name; ?>/currency/INR">Rupee (₹ )</a></li>
                            <li><a href="/<?php print $store_name; ?>/currency/RUB">Ruble (руб)</a></li>
                        </ul>
                    </li>
                    <?php } ?>
                    <li class="divider-vertical"></li>
                    <li class="cart-total" data-currency="<?php print $store_currency; ?>"><a><?php print $store_currency; ?>0.00</a></li>
                    <li class="divider-vertical"></li>

                    <!-- cart is here -->
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-shopping-cart icon-white"></i> <span class="label label-success">0</span> <?php print $lang->get('global.menu_cart'); ?><b class="caret"></b></a>
                        <div class="dropdown-menu span4 cart-content">
                            <h3><?php print $lang->get('global.menu_cart_empty'); ?></h3>
                        </div>
                    </li>
                </ul>
                <?php } ?>

            </div>
        </div>
    </div>
