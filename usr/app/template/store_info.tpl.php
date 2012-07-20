        <div class="row">

            <div class="span12">
                <div class="hero-unit">
                    <?php
                    print $helper->title(sprintf($lang->get('store_content.info_title'), $store->name));
                    $placeholder    = '';
                    if (empty($store->info)) {
                        $store->info = $lang->get('store_content.no_info');
                        if (!empty($admin)) {
                            $store->info  .= $lang->get('store_content.intructions');
                            $placeholder    = $store->info;
                            $store->info   = null;
                        }
                    }
                    if (!empty($admin)) {
                        ?>
                        <div class="alert alert-block alert-success fade out hide">
                            <button data-dismiss="alert" class="close" type="button">×</button>
                            <h4 class="alert-heading"><?php print $lang->get('store_content.success_title'); ?></h4>
                            <p><?php print $lang->get('store_content.success_message'); ?></p>
                        </div>
                        <form method="post">
                            <fieldset>
                                <div class="control-group">
                                    <label class="control-label" for="info"><?php print $lang->get('store_content.description'); ?></label>
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
