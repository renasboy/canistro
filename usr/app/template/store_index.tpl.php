        <div class="row">

            <?php if (empty($store->products)) { ?>

            <div class="span12">
                <div class="hero-unit">
                    <h1>This is the <?php print $store_name; ?> store</h1>
                    <p>
                    <?php if (!empty($admin)) { ?>
                    In order to create your first product just click the add product button.
                    <?php } else { ?>
                    There are no current products in the store, and this means they are probably being prepared right now, so please come back later.
                    <?php } ?>
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
                            <?php print str_replace('height="1080"', null, $helper->image($product->img, $product->name, 1920, 1080)); ?>
                            <div class="carousel-caption">
                                <p class="pull-right">
                                <?php if (!empty($admin)) { ?>
                                <a href="#" class="btn btn-large product-edit"><i class="icon-pencil"></i> EDIT</a>
                                <?php if (!empty($product->active)) { ?>
                                <a href="#" class="btn btn-large product-flag"><i class="icon-off"></i> ON</a>
                                <?php } else { ?>
                                <a href="#" class="btn btn-large product-flag"><i class="icon-off"></i> OFF</a>
                                <?php } ?>
                                <?php } ?>
                                <a class="btn btn-large btn-primary add-cart" href="#" data-product="<?php print $product->id; ?>"><i class="icon-plus icon-white"></i> &euro;<?php print $product->price; ?></a>
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
                    <div class="span9 checkout"><a class="btn-success btn-large btn pull-right" data-target="#modal-form-checkout" href="#modal-form-checkout" data-toggle="modal"><i class="icon-ok icon-white"></i> CHECKOUT</a></div>
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
                            <a class="btn btn-mini btn-primary pull-right add-cart" href="#" data-product="<?php print $product->id; ?>"><i class="icon-plus icon-white"></i> &euro;<?php print $product->price; ?></a>
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
