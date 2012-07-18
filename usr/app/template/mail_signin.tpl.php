<?php
$host   = sprintf('http://%s', $conf->get('base_host'));
$store  = sprintf('%s/%s', $host, $name);
$link   = sprintf('%s/signin?token=%s', $host, $token);

print $helper->description($lang->get('mail_signin.line1')); 
print $helper->description(sprintf($lang->get('mail_signin.line2'), $store, $name, $host)); 
print $helper->description(sprintf($lang->get('mail_signin.line3'), $link)); 
print $helper->description(sprintf($lang->get('mail_signin.line4'), $link)); 
print $helper->description($lang->get('mail_signin.line5')); 
print $helper->description($lang->get('mail_signin.line6')); 
