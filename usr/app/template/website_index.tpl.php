        <div class="row">

            <div class="span9">
                <div class="hero-unit">
                    <h1>Canistro</h1>
                    <h2><?php print $lang->get('index.motto'); ?></h2>
                    <p><?php print $lang->get('index.submotto'); ?></p>
                    <p>
                        <a class="btn btn-success btn-large" data-target="#modal-form" href="#modal-form" data-toggle="modal"><?php print $lang->get('index.try_now_label'); ?></a>
                    </p>
                    <p class="visible-desktop"><?php print $lang->get('index.description1'); ?></p>
                    <p class="visible-desktop"><?php print $lang->get('index.description2'); ?></p>

                    <div class="pull-right social">

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

                    <p><?php print $lang->get('index.description3'); ?></p>

                </div>
            </div>

            <div class="span3 visible-desktop">
                <h2><?php print $lang->get('index.highlight_title'); ?></h2>
                <p><?php print $lang->get('index.highlight_intro'); ?></p>
                <ul class="thumbnails">
                    <li class="span3">
                    <?php
                    if (!empty($highlight)) {
                        $index = count($highlight->products) - 1;
                        ?>
                    <div class="thumbnail">
                        <a href="/<?php print $highlight->name; ?>"><?php print str_replace('height="146"', null, $helper->image($highlight->products[$index]->img, $highlight->products[$index]->name, 260, 146)); ?></a>
                        <div class="caption">
                            <h5><?php print $highlight->name; ?></h5>
                            <?php if (!empty($highlight->about)) { ?>
                            <p><?php print substr(strip_tags($highlight->about), 0, 255); ?></p>
                            <?php } ?>
                            <p><a class="btn btn-primary pull-right" href="/<?php print $highlight->name; ?>"><?php print $lang->get('index.highlight_go_shop_label'); ?></a> <a class="btn" href="/<?php print $highlight->name; ?>/contact"><?php print $lang->get('index.highlight_contact_label'); ?></a></p>
                        </div>
                    </div>
                    <?php } ?>
                    </li>
                </ul>
            </div>
        </div> 

    <?php $view->add('website_signup'); ?>

    <a href="https://github.com/renasboy/canistro" class="github visible-desktop"><img src="/img/fork-me-on-github.png" alt="fork canistro on github"></a>
