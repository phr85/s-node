<?php
// Deactivate Entry
XT::query("UPDATE " . XT::getTable('guestbook') . " SET active = 0 WHERE id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);
?>