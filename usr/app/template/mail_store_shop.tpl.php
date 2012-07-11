<p>Hi owner of <?php print $name; ?>,</p>

<p>An order was placed at the store <a href="<?php print sprintf('http://%s/%s', $conf->get('base_host'), $name); ?>"><?php print $name; ?></a> hosted at <a href="http://<?php print $conf->get('base_host'); ?>">canistro, your personal e-commerce</a>.</p>

<p>Thank you very very much from canistro team.</p>
