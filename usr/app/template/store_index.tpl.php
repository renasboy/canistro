        <div class="row">

            <?php if (empty($store->products)) { ?>

            <div class="span12">
                <div class="hero-unit">
                    <h1><?php printf($lang->get('store_index.title'), $store_name); ?></h1>
                    <p>
                    <?php
                    if (!empty($admin)) {
                        $lang->get('store_index.no_products_admin');
                    }
                    else {
                        $lang->get('store_index.no_products');
                    }
                    ?>
                    </p>
                </div>
            </div>

            <?php } else { ?> 

            <div class="span9">
                <div id="product-carousel" class="carousel slide">
                    <!-- Carousel items -->
                    <div class="carousel-inner">
                        <?php foreach ($store->products as $key => $product) { ?>
                        <div class="item<?php print $key == 0 ? ' active' : null; ?><?php print empty($product->active) ? ' off' : null; ?>" data-id="<?php print $product->id; ?>" data-product='<?php print json_encode($product, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>' data-slide="<?php print $key; ?>">
                            <?php print str_replace('height="540"', null, $helper->image($product->img, $product->name, 960, 540)); ?>
                            <div class="carousel-caption">
                                <p class="pull-right">
                                <?php if (!empty($admin)) { ?>
                                <a href="#" class="btn btn-large product-edit"><i class="icon-pencil"></i> <?php print $lang->get('store_index.edit_label'); ?></a>
                                <?php if (!empty($product->active)) { ?>
                                <a href="#" class="btn btn-large product-flag"><i class="icon-off"></i> <?php print $lang->get('store_index.on_label'); ?></a>
                                <?php } else { ?>
                                <a href="#" class="btn btn-large product-flag"><i class="icon-off"></i> <?php print $lang->get('store_index.off_label'); ?></a>
                                <?php } ?>
                                <?php } ?>
                                <a class="btn btn-large btn-primary add-cart" href="#" data-product="<?php print $product->id; ?>"><i class="icon-plus icon-white"></i> <?php print $store_currency; ?><?php print $product->price; ?></a>
                                </p>
                                <h4><?php print $product->name; ?></h4>
                                <?php if (!empty($product->description)) { ?>
                                <p class="visible-desktop"><?php print $product->description; ?></p>
                                <?php } ?>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <!-- Carousel nav -->
                    <a class="carousel-control left" href="#product-carousel" data-slide="prev">&lsaquo;</a>
                    <a class="carousel-control right" href="#product-carousel" data-slide="next">&rsaquo;</a>
                </div>

                <div class="row">
                    <div class="span9 checkout"><a class="btn-success btn-large btn pull-right" data-target="#modal-form-checkout" href="#modal-form-checkout" data-toggle="modal"><i class="icon-ok icon-white"></i> <?php print $lang->get('store_index.checkout_label'); ?></a></div>
                </div>

            </div>

            <div class="span3">
                <div class="thumbnails-wrapper">
                <ul class="thumbnails">
                    <?php foreach ($store->products as $key => $product) { ?>
                    <li class="span3">
                    <div class=" <?php print $key == 0 ? 'selected ' : null; ?>thumbnail carousel">
                        <div class="carousel-inner">
                        <a data-id="<?php print $product->id; ?>" href="#" data-slide="<?php print $key; ?>"><?php print str_replace('height="146"', null, $helper->image($product->img, $product->name, 260, 146)); ?></a>
                        <div class="carousel-caption">
                            <a class="btn btn-mini btn-primary pull-right add-cart" href="#" data-product="<?php print $product->id; ?>"><i class="icon-plus icon-white"></i> <?php print $store_currency; ?><?php print $product->price; ?></a>
                            <h5 class="visible-desktop"><?php print $product->name; ?></h5>
                        </div>
                        </div>
                    </div>
                    </li>
                    <?php } ?>
                </ul>
                </div>
            </div>

            <?php } ?>

        </div>
<?php $view->add('store_checkout'); ?>
<?php if (!empty($admin)) { ?>
<?php $view->add('store_product'); ?>
<?php } ?>
