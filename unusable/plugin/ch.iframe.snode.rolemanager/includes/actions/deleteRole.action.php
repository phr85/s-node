<?php
// Delete Role
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('roles') . " WHERE id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);
XT::log("Role " . $GLOBALS['plugin']->getValue('id') . " has been deleted.",__FILE__,__LINE__,XT_INFO);
?>
