<?php
// Delete user from group
$GLOBALS['plugin']->setAdminModule('e');
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('user_groups') . " WHERE user_id = " . $GLOBALS['plugin']->getValue("user_id") . " AND group_id = " . $GLOBALS['plugin']->getSessionValue("id"),__FILE__,__LINE__);
?>
