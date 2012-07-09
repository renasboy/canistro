        <div class="row">

            <div class="span12">
                <div class="hero-unit">
                    <?php
                    print $helper->title(sprintf('Payment &amp; delivery by %s', $store->name));
                    if (empty($store->info)) {
                        $store->info = sprintf('No payment and delivery information for %s was added.', $store->name);
                    }
                    print $helper->description($store->info);
                    ?>
                </div>
            </div>

        </div>
