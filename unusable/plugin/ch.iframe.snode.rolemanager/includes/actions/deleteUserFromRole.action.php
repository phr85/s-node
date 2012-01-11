<?php
// Delete user from role
$GLOBALS['plugin']->setAdminModule('e');

XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('user_roles') . " WHERE user_id = " . $GLOBALS['plugin']->getValue("user_id") . " AND role_id = " . $GLOBALS['plugin']->getSessionValue("id"),__FILE__,__LINE__);
?>
