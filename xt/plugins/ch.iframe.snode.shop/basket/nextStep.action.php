<?php
$GLOBALS['plugin']->setSessionValue('OPSTEP',2);
$op  = $GLOBALS['plugin']->getConfig("orderprocess");
header("Location:" . $_SERVER['PHP_SELF'] . "?TPL=" . $op[2]['tpl']);
?>
