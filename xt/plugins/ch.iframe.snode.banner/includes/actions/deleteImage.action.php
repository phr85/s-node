<?php

$GLOBALS['plugin']->call("saveBanner");
XT::query("UPDATE " . $GLOBALS['plugin']->getTable('banner') . " SET image = NULL, image_version = NULL WHERE id = " . $GLOBALS['plugin']->getSessionValue('banner_id'),__FILE__,__LINE__);
$GLOBALS['plugin']->setAdminModule("eb");

?>
