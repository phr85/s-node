<?php

$GLOBALS['plugin']->call("savePageSimple");
XT::query("UPDATE " . $GLOBALS['plugin']->getTable('navigation_details') . " SET " . XT::getValue('field') . " = NULL, image_version = NULL WHERE lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND node_id = " . $GLOBALS['plugin']->getValue('node_id'),__FILE__,__LINE__);
$GLOBALS['plugin']->setAdminModule("es");

?>
