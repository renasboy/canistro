        <div class="row">

            <div class="span12">
                <div class="hero-unit">
                    <?php
                    print $helper->title(sprintf('Contact %s', $store->name));
                    if (empty($store->contact)) {
                        $store->contact = sprintf('No contact information for %s was added.', $store->name);
                    }
                    print $helper->description($store->contact);
                    ?>
                </div>
            </div>

        </div>
