<div class="container">
    <div class="row">
        <div class="span12">
            <footer class="footer">
                <p>

                <?php
                if (!empty($admin)) {
                    if (!empty($admin_button)) {
                    ?>
                <a class="btn-success btn-large btn pull-right product-add" data-target="#modal-form-product" href="#modal-form-product" data-toggle="modal"><i class="icon-plus icon-white"></i> NEW PRODUCT</a>
                <?php } else { ?>
                <a class="btn-success btn-large btn pull-right content-edit" href="#"><i class="icon-pencil icon-white"></i> SAVE THIS PAGE</a>
                <?php
                    }
                }
                ?>

                <a href="/">canistro online</a> 2012 - copyleft by linux for me 2009 - <?php print date('Y'); ?><br>
                designed and build by renasboy with <a href="https://github.com/renasboy/php-mysql-micro-framework">php mysql micro framework</a>.<br>
                </p>

                <?php if (!empty($store_name)) { ?>
                    <div class="social visible-desktop">

                        <div id="fb-root"></div>
                        <script>(function(d, s, id) {
                          var js, fjs = d.getElementsByTagName(s)[0];
                          if (d.getElementById(id)) return;
                          js = d.createElement(s); js.id = id;
                          js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                          fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));</script>
                        <div class="fb-like" data-send="false" data-layout="box_count" data-width="20" data-show-faces="false"></div>

                        <a href="https://twitter.com/share" class="twitter-share-button" data-count="vertical" data-lang="en">Tweet</a>
                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

                        <div class="g-plusone" data-size="tall"></div>
                        <script type="text/javascript">
                          window.___gcfg = {lang: 'en-GB'};
                          (function() {
                            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                            po.src = 'https://apis.google.com/js/plusone.js';
                            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                          })();
                        </script>
                    </div>
                <?php }?>

            </footer>
        </div>
    </div>
</div>
