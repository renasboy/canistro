    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="brand" href="/"><img src="/img/canistro-logo-small.png" height="20" width="60" alt="Canistro Online - Logo"> <sup><span class="label label-important">beta</span></sup></a>

                <ul class="nav">
                    <li class="home visible-desktop"><a href="/"><?php print $lang->get('global.menu_home'); ?></a></li>
                    <li class="about"><a href="/about"><?php print $lang->get('global.menu_about'); ?></a></li>
                    <li class="browse"><a href="/browse"><?php print $lang->get('global.menu_browse'); ?></a></li>
                    <li class="contact"><a href="/contact"><?php print $lang->get('global.menu_contact'); ?></a></li>
                </ul>
 
                <form method="post" action="signin" class="navbar-form pull-right form-inline">
                    <div class="control-group">
                    <i class="icon-user icon-white"></i>
                    <input type="text" name="username" class="span2" placeholder="<?php print $lang->get('global.menu_username'); ?>">
                    <button type="submit" class="btn" id="signin"><?php print $lang->get('global.menu_signin'); ?></button>
                    </div>
                </form>
                <span class="label label-success pull-right fade hide"><?php print $lang->get('global.menu_signin_success'); ?></span> 
                <span class="label label-important pull-right fade hide"><?php print $lang->get('global.menu_signin_failed'); ?></span> 

            </div>
        </div>
    </div>
