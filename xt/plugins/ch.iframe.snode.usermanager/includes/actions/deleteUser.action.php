<?php
// Create action function
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('user') . " WHERE id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);
XT::log("User " . $GLOBALS['plugin']->getValue('id') . " has been deleted.",__FILE__,__LINE__,XT_INFO);

?>