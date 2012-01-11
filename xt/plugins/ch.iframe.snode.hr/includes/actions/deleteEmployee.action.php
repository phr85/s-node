<?php

XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("employees") . " WHERE id = '" . $GLOBALS['plugin']->getValue("id") . "'",__FILE__,__LINE__);

$GLOBALS['plugin']->setAdminModule("o");

?>
