        <div class="row">

            <div class="span12">
                <div class="hero-unit">
                    <?php
                    print $helper->title($lang->get('confirm.title'));
                    print $helper->description(sprintf($lang->get('confirm.description'), 'http://' . $conf->get('base_host') . '/' . $store_name));
                    ?>
                </div>
            </div>

        </div>
