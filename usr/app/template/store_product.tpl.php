    <div class="modal fade hide" id="modal-form-product">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h3><?php print $lang->get('store_product.title'); ?></h3>
        </div>
        <div class="modal-body">

            <div class="alert alert-block alert-success fade out hide">
                <button data-dismiss="alert" class="close" type="button">×</button>
                <h4 class="alert-heading"><?php print $lang->get('store_product.success_title'); ?></h4>
                <p><?php printf($lang->get('store_product.success_message'), $store_name); ?></p>
            </div>

            <div class="alert alert-block alert-error fade out hide">
                <button data-dismiss="alert" class="close" type="button">×</button>
                <h4 class="alert-heading"><?php print $lang->get('store_product.failed_title'); ?></h4>
                <p><?php print $lang->get('store_product.failed_message'); ?></p>
            </div>

            <form class="form-horizontal" method="post">
                <input type="hidden" name="id" id="id" value="">
                <fieldset>
                    <div class="control-group">
                        <input type="hidden" name="img" id="img" value="">
                        <label class="control-label" for="image"><?php print $lang->get('store_product.upload_label'); ?></label>
                        <div class="controls">
                            <img src="http://placehold.it/80&text=browse" alt="upload image" class="pull-left" id="upload-image">
                            <a href="#" class="btn" id="upload"><?php print $lang->get('store_product.upload_image'); ?></a>
                            <p class="help-block"><?php print $lang->get('store_product.upload_info'); ?></p>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="name"><?php print $lang->get('store_product.name_label'); ?></label>
                        <div class="controls">
                            <input type="text" name="name" id="name" class="span3" placeholder="<?php print $lang->get('store_product.name_placeholder'); ?>">
                            <p class="help-block"><?php print $lang->get('store_product.name_info'); ?></p>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="price"><?php print $lang->get('store_product.price_label'); ?></label>
                        <div class="controls">
                            <div class="input-append input-prepend">
                            <span class="add-on"><?php print $store_currency; ?></span><input type="text" class="span1" name="price" id="price" placeholder="100"><span class="add-on">.00</span>
                            </div>
                            <p class="help-block"><?php print $lang->get('store_product.price_info'); ?></p>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="description"><?php print $lang->get('store_product.description_label'); ?></label>
                        <div class="controls">
                            <textarea type="text" name="description" id="description" class="span3" placeholder="<?php print $lang->get('store_product.description_placeholder'); ?>"></textarea>
                            <p class="help-block"><?php print $lang->get('store_product.description_info'); ?></p>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn" data-dismiss="modal"><?php print $lang->get('store_product.cancel'); ?></a>
            <a href="#" class="btn btn-primary" id="product"><?php print $lang->get('store_product.submit'); ?></a>
        </div>
    </div>
