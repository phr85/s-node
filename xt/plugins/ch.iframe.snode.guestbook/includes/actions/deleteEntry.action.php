<?php
// Delete Entry
XT::query("DELETE FROM " . XT::getTable('guestbook') . " WHERE id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);
XT::log("Message deleted successfully",__FILE__,__LINE__,XT_INFO);
?>