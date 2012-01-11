<?php

$GLOBALS['plugin']->setSessionValue('OPSTEP',1);
$op  = $GLOBALS['plugin']->getConfig("orderprocess");
header("Location:" . $_SERVER['PHP_SELF'] . "?TPL=" . $op[1]['tpl']);

?>