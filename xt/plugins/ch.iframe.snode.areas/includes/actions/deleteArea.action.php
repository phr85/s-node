<?php

$result = XT::query("SELECT pos FROM " . $GLOBALS['plugin']->getTable("areas") . " WHERE id = " . $GLOBALS['plugin']->getValue("id"),__FILE__,__LINE__);
$data = XT::getQueryData($result);

XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("areas") . " WHERE id = " . $GLOBALS['plugin']->getValue("id"),__FILE__,__LINE__);
XT::query("UPDATE " . $GLOBALS['plugin']->getTable("areas") . " SET pos = pos - 1 WHERE pos > " . $data[0]['pos']);

$GLOBALS['plugin']->setAdminModule("o");

?>
