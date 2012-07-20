<?php
$host   = sprintf('http://%s', $conf->get('base_host'));
$store  = sprintf('%s/%s', $host, $name);

print $helper->description(sprintf($lang->get('mail_shop.line1'), $name)); 
print $helper->description(sprintf($lang->get('mail_shop.line2'), $store, $name, $host)); 
print $helper->description($lang->get('mail_shop.line3')); 
