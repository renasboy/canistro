        <div class="row">

            <div class="span12">
                <div class="hero-unit">
                    <?php
                    print $helper->title(sprintf('About %s', $store->name));
                    if (empty($store->about)) {
                        $store->about = sprintf('No about information for %s was added.', $store->name);
                    }
                    print $helper->description($store->about);
                    ?>
                </div>
            </div>

        </div>
