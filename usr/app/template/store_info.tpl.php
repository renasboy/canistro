        <div class="row">

            <div class="span12">
                <div class="hero-unit">
                    <?php
                    print $helper->title(sprintf('Payment &amp; delivery by %s', $store->name));
                    $placeholder    = '';
                    if (empty($store->info)) {
                        $store->info = sprintf('No payment and delivery information for %s was added.', $store->name);
                        if (!empty($admin)) {
                            $store->info  .= 'Click the save this page button to save your changes to the contents of this page.';
                            $placeholder    = $store->info;
                            $store->info   = null;
                        }
                    }
                    if (!empty($admin)) {
                        ?>
                        <div class="alert alert-block alert-success fade out hide">
                            <button data-dismiss="alert" class="close" type="button">×</button>
                            <h4 class="alert-heading">Saved!</h4>
                            <p>Changes were saved sucessfully.</p>
                        </div>
                        <form method="post">
                            <fieldset>
                                <div class="control-group">
                                    <label class="control-label" for="info">this is the payment and delivery page contents, simple editor can be used to compose text visible to users, use save this page button to save your changes.</label>
                                    <div class="controls">
                                    <?php print '<textarea name="info" id="info" class="span9" placeholder="' . $placeholder . '">' . $store->info . '</textarea>'; ?>
                                    <p class="help-block"></p>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                        <?php
                    }
                    else {
                        print $helper->description($store->info);
                    }
                    ?>
                </div>
            </div>

        </div>
