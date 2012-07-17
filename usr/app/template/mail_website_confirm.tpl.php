<?php
$host   = sprintf('http://%s', $conf->get('base_host'));
$store  = sprintf('%s/%s', $host, $name);
$link   = sprintf('%s/confirm/%d/%s', $host, $store_id, $token);

print $helper->description($lang->get('mail_confirm.line1')); 
print $helper->description(sprintf($lang->get('mail_confirm.line2'), $store, $name, $host)); 
print $helper->description(sprintf($lang->get('mail_confirm.line3'), $link)); 
print $helper->description(sprintf($lang->get('mail_confirm.line4'), $link)); 
print $helper->description($lang->get('mail_confirm.line5')); 
print $helper->description($lang->get('mail_confirm.line6')); 
