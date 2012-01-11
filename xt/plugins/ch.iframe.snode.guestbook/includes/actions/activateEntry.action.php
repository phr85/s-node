<?php
// Activate Entry
XT::query("UPDATE " . XT::getTable('guestbook') . " SET active = 1 WHERE id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);
?>