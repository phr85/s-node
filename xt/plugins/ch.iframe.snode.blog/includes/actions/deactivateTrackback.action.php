<?php
XT::query("UPDATE " . XT::getTable("comments_trackback_incomming") . " set active=0 WHERE id = " . XT::getValue('trackback_id'),__FILE__,__LINE__);
$GLOBALS['plugin']->setAdminModule("t");
?>