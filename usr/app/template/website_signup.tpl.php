    <div class="modal fade hide" id="modal-form">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h3>Create new canistro store now!</h3>
        </div>
        <div class="modal-body">

            <div class="alert alert-block alert-success fade out hide">
                <button data-dismiss="alert" class="close" type="button">×</button>
                <h4 class="alert-heading">Thank you for creating your canistro!</h4>
                <p>We sent you an email with the activation link for your first login.</p>
            </div>

            <form class="form-horizontal" method="post">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="email">your email address</label>
                        <div class="controls">
                            <input type="text" name="email" id="email" class="span3" placeholder="renasboy@highlinux.com">
                            <p class="help-block">enter your email address here</p>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="name">your canistro's name</label>
                        <div class="controls">
                            <div class="input-prepend">
                            <span class="add-on"><?php print $conf->get('base_host'); ?>/</span><input type="text" class="span2" name="name" id="name" placeholder="renasboy">
                            </div>
                            <p class="help-block">enter your canistro's name here</p>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn" data-dismiss="modal">maybe later...</a>
            <a href="#" class="btn btn-primary" id="done">done!</a>
        </div>
    </div>
