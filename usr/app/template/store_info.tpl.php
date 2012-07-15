        <div class="row">

            <div class="span12">
                <div class="hero-unit">
                    <?php
                    print $helper->title(sprintf('Payment &amp; delivery by %s', $store->name));
                    if (empty($store->info)) {
                        $store->info = sprintf('No payment and delivery information for %s was added.', $store->name);
                        if (!empty($admin)) {
                            $store->info .= '<br>Click the edit this page button to change the contents of this page.';
                        }
                    }
                    print $helper->description($store->info);
                    ?>
                </div>
            </div>

        </div>
