    <div class="modal fade hide" id="modal-form">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h3>Checkout this order now!</h3>
        </div>
        <div class="modal-body">

            <div class="alert alert-block alert-success fade out hide">
                <button data-dismiss="alert" class="close" type="button">×</button>
                <h4 class="alert-heading">Thank you for ordering our products!</h4>
                <p>We sent you an email with the confirmation link.</p>
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
                        <label class="control-label" for="address">your delivery address</label>
                        <div class="controls">
                            <textarea type="text" name="address" id="address" class="span3" placeholder="Street - City - Country - Postalcode"></textarea>
                            <p class="help-block">enter your address for delivery here</p>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="comments">comments or remarks</label>
                        <div class="controls">
                            <textarea type="text" name="comments" id="comments" class="span3" placeholder="Enter your comment or remark here..."></textarea>
                            <p class="help-block">enter your comments here</p>
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
