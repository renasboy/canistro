    <div class="modal fade hide" id="modal-form-product">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h3>Product management</h3>
        </div>
        <div class="modal-body">

            <div class="alert alert-block alert-success fade out hide">
                <button data-dismiss="alert" class="close" type="button">×</button>
                <h4 class="alert-heading">Thank you for ordering our products!</h4>
                <p>Changes were saved sucessfully. To see the changes please refresh the page or click <a href="/<?php print $store_name; ?>">here</a></p>
            </div>

            <div class="alert alert-block alert-error fade out hide">
                <button data-dismiss="alert" class="close" type="button">×</button>
                <h4 class="alert-heading">Upload failed!</h4>
                <p>The image upload failed please try again.</p>
            </div>

            <form class="form-horizontal" method="post">
                <fieldset>
                    <div class="control-group">
                        <input type="hidden" name="img" id="img" value="">
                        <label class="control-label" for="image">product image</label>
                        <div class="controls">
                            <img src="http://placehold.it/80&text=browse" alt="upload image" class="pull-left" id="upload-image">
                            <a href="#" class="btn" id="upload">upload image</a>
                            <p class="help-block">upload product image here</p>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="name">product name</label>
                        <div class="controls">
                            <input type="text" name="name" id="name" class="span3" placeholder="product name">
                            <p class="help-block">enter product name here</p>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="price">product price</label>
                        <div class="controls">
                            <div class="input-append input-prepend">
                            <span class="add-on">&euro;</span><input type="text" class="span1" name="price" id="price" placeholder="100"><span class="add-on">.00</span>
                            </div>
                            <p class="help-block">enter produce price here</p>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="description">product description (optional)</label>
                        <div class="controls">
                            <textarea type="text" name="description" id="description" class="span3" placeholder="Describe the product in a couple of senteces, this can help other to find your product easily."></textarea>
                            <p class="help-block">enter product description here</p>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn" data-dismiss="modal">maybe later...</a>
            <a href="#" class="btn btn-primary" id="product">done!</a>
        </div>
    </div>
