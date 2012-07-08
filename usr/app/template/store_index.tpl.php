        <div class="row">

            <div class="span9">
                <div id="product-carousel" class="carousel slide">
                    <!-- Carousel items -->
                    <div class="carousel-inner">
                        <div class="active item">
                            <img alt="" src="http://placehold.it/1920x1080">
                            <div class="carousel-caption">
                                <h4>This is the product #1</h4>
                                <p><a class="btn btn-primary pull-right" href="#">&euro;40.00</a></p>
                                <p>this is a description for the product #1, this description can be long. this is a description for the product #1, this description can be long.</p>
                            </div>
                        </div>

                        <div class="item">
                            <img alt="" src="http://placehold.it/1920x1080">
                            <div class="carousel-caption">
                                <h4>This is the product #2</h4>
                                <p><a class="btn btn-primary pull-right" href="#">&euro;15.00</a></p>
                                <p>this is a description for the product #2, this description can be long. this is a description for the product #2, this description can be long.</p>
                            </div>
                        </div>

                        <div class="item">
                            <img alt="" src="http://placehold.it/1920x1080">
                            <div class="carousel-caption">
                                <h4>This is the product #3</h4>
                                <p><a class="btn btn-primary pull-right" href="#">&euro;20.00</a></p>
                                <p>this is a description for the product #3, this description can be long. this is a description for the product #3, this description can be long.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Carousel nav -->
                    <a class="carousel-control left" href="#product-carousel" data-slide="prev">&lsaquo;</a>
                    <a class="carousel-control right" href="#product-carousel" data-slide="next">&rsaquo;</a>
                </div>

                <div class="row">
                    <div class="span9"><a class="btn-success btn-large btn pull-right" href="/renasboy/checkout">CHECKOUT</a></div>
                </div>

            </div>

            <div class="span3">
                <ul class="thumbnails">
                    <?php foreach ([0,1,2] as $i) { ?>
                    <li class="span3">
                    <div class="thumbnail carousel">
                        <div class="carousel-inner">
                        <a href="#"><img alt="" src="http://placehold.it/260x146"></a>
                        <div class="carousel-caption">
                            <a class="btn btn-primary pull-right" href="#">&euro;40.00</a>
                            <h4>product #1</h4>
                        </div>
                        </div>
                    </div>
                    </li>
                    <?php } ?>
                </ul>
            </div>

        </div>
