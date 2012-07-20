    <div class="modal fade hide" id="modal-form-checkout">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h3><?php print $lang->get('store_checkout.title'); ?></h3>
        </div>
        <div class="modal-body">

            <div class="alert alert-block alert-success fade out hide">
                <button data-dismiss="alert" class="close" type="button">×</button>
                <h4 class="alert-heading"><?php print $lang->get('store_checkout.success_title'); ?></h4>
                <p><?php printf($lang->get('store_checkout.success_message'), $store_name); ?></p>
            </div>

            <form class="form-horizontal" method="post">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="email"><?php print $lang->get('store_checkout.email_label'); ?></label>
                        <div class="controls">
                            <input type="text" name="email" id="email" class="span3" placeholder="<?php print $lang->get('store_checkout.email_placeholder'); ?>">
                            <p class="help-block"><?php print $lang->get('store_checkout.email_info'); ?></p>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="address"><?php print $lang->get('store_checkout.contact_label'); ?></label>
                        <div class="controls">
                            <textarea type="text" name="address" id="address" class="span3" placeholder="<?php print $lang->get('store_checkout.contact_placeholder'); ?>"></textarea>
                            <p class="help-block"><?php print $lang->get('store_checkout.contact_info'); ?></p>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="comments"><?php print $lang->get('store_checkout.comments_label'); ?></label>
                        <div class="controls">
                            <textarea type="text" name="comments" id="comments" class="span3" placeholder="<?php print $lang->get('store_checkout.comments_placeholder'); ?>"></textarea>
                            <p class="help-block"><?php print $lang->get('store_checkout.comments_info'); ?></p>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn" data-dismiss="modal"><?php print $lang->get('store_checkout.cancel'); ?></a>
            <a href="#" class="btn btn-primary" id="done"><?php print $lang->get('store_checkout.submit'); ?></a>
        </div>
    </div>
