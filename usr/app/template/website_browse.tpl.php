        <div class="row">

            <div class="span12">
                <?php if (empty($stores)) { ?>
                <div class="hero-unit">
                    <h1><?php print $lang->get('browse.no_store_title'); ?></h1>
                    <p><?php print $lang->get('browse.no_store_description1'); ?></p>
                    <p><?php print $lang->get('browse.no_store_description2'); ?></p>
                </div>
                <?php } else {
                    
                    foreach ($stores as $store) {

                        if (empty($store->products)) {
                            continue;
                        }
                        $product = $store->products[0];
                        ?>
                <div class="span3">
                    <ul class="thumbnails">
                        <li class="span3">
                        <div class="thumbnail">
                            <a href="/<?php print $store->name; ?>"><?php print str_replace('height="146"', null, $helper->image($product->img, $product->name, 260, 146)); ?></a>
                            <div class="caption">
                                <h5><?php print $store->name; ?></h5>
                                <?php if (!empty($store->about)) { ?>
                                <p><?php print substr(strip_tags($store->about), 0, 100); ?>...</p>
                                <?php } ?>
                                <p><a class="btn btn-primary pull-right" href="/<?php print $store->name; ?>"><?php print $lang->get('browse.go_shop_label'); ?></a> <a class="btn" href="/<?php print $store->name; ?>/contact"><?php print $lang->get('browse.contact_label'); ?></a></p>
                            </div>
                        </div>
                        </li>
                    </ul>
                </div>
                    <?php } ?>

                <?php } ?>
            </div>

        </div>
