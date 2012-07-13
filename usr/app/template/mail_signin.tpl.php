<?php $link = sprintf('http://%s/signin?token=%s', $conf->get('base_host'), $token); ?>
<p>Hi there,</p>

<p>You requested a sign in at <a href="<?php print sprintf('http://%s/%s', $conf->get('base_host'), $name); ?>"><?php print $name; ?></a> store hosted at <a href="http://<?php print $conf->get('base_host'); ?>">canistro, your personal e-commerce</a>.</p>

<p>Here is your <a href="<?php print $link; ?>">link</a> for sign in.</p>

<p>
If the link for any reason does not work, copy the following address to your browser's address bar:
<?php print $link; ?>
</p>

<p>We sent this email for your security, to make sure no one else is making use of your canistro account.</p>

<p>Thank you very much from canistro team.</p>
