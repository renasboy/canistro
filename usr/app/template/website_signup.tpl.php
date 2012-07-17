    <div class="modal fade hide" id="modal-form">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h3><?php print $lang->get('signup.title'); ?></h3>
        </div>
        <div class="modal-body">

            <div class="alert alert-block alert-success fade out hide">
                <button data-dismiss="alert" class="close" type="button">×</button>
                <h4 class="alert-heading"><?php print $lang->get('signup.success_title'); ?></h4>
                <p><?php print $lang->get('signup.success_message'); ?></p>
            </div>

            <form class="form-horizontal" method="post">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="email"><?php print $lang->get('signup.email_label'); ?></label>
                        <div class="controls">
                            <input type="text" name="email" id="email" class="span3" placeholder="<?php print $lang->get('signup.email_placeholder'); ?>">
                            <p class="help-block"><?php print $lang->get('signup.email_info'); ?></p>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="name"><?php print $lang->get('signup.name_label'); ?></label>
                        <div class="controls">
                            <div class="input-prepend">
                            <span class="add-on"><?php print $conf->get('base_host'); ?>/</span><input type="text" class="span2" name="name" id="name" placeholder="<?php print $lang->get('signup.name_placeholder'); ?>">
                            </div>
                            <p class="help-block"><?php print $lang->get('signup.name_info'); ?></p>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn" data-dismiss="modal"><?php print $lang->get('signup.cancel'); ?></a>
            <a href="#" class="btn btn-primary" id="done"><?php print $lang->get('signup.submit'); ?></a>
        </div>
    </div>
