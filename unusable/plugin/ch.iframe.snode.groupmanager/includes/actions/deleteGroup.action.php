<?php
// Delete Group
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('groups') . " WHERE id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);
XT::log("Group " . $GLOBALS['plugin']->getValue('id') . " has been deleted.",__FILE__,__LINE__,XT_INFO);
?>
