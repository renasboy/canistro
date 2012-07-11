<?php $link = sprintf('http://%s/%s/confirm/%d/%s', $conf->get('base_host'), $name, $shop_id, $token); ?>
<p>Hi there,</p>

<p>Your email address was used to place an order at the store <a href="<?php print sprintf('http://%s/%s', $conf->get('base_host'), $name); ?>"><?php print $name; ?></a> hosted at <a href="http://<?php print $conf->get('base_host'); ?>">canistro, your personal e-commerce</a>.</p>

<p>If this order was indeed placed by you, please follow this <a href="<?php print $link; ?>">link</a> to confirm it.</p>

<p>
If the link for any reason does not work, copy the following address to your browser's address bar:
<?php print $link; ?>
</p>

<p>We sent this email for your security, to make sure no one else is using your email to make purchages.</p>

<p>Thank you very much from <?php print $name; ?> team.</p>

<p>Thank you very very much from canistro team.</p>
