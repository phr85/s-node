<?php

$GLOBALS['plugin']->call($GLOBALS['plugin']->getValue("wizard") . "_" . ($GLOBALS['plugin']->getValue("step")-1));
$GLOBALS['plugin']->setAdminModule($GLOBALS['plugin']->getValue("wizard") . "_" . $GLOBALS['plugin']->getValue("step"));

?>
