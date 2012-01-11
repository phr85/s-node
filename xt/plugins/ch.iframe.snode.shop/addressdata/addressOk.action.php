<?php

XT::setSessionValue('shipping_address',XT::getValue('shipping_address'));
XT::setSessionValue('billing_address',XT::getValue('billing_address'));

XT::setSessionValue('OPSTEP',3);
$op  = XT::getConfig("orderprocess");
header("Location:" . $_SERVER['PHP_SELF'] . "?TPL=" . $op[3]['tpl']);
?>