<?php
XT::query("DELETE FROM " . XT::getTable("comments_trackback_incomming") . " WHERE id = " . XT::getValue('trackback_id'),__FILE__,__LINE__);
$GLOBALS['plugin']->setAdminModule("t");
?>