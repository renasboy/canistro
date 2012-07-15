        <div class="row">

            <div class="span12">
                <div class="hero-unit">
                    <?php
                    print $helper->title(sprintf('Contact %s', $store->name));
                    if (empty($store->contact)) {
                        $store->contact = sprintf('No contact information for %s was added.', $store->name);
                        if (!empty($admin)) {
                            $store->contact.= '<br>Click the edit this page button to change the contents of this page.';
                        }
                    }
                    print $helper->description($store->contact);
                    ?>
                </div>
            </div>

        </div>
