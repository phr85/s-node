<?php
//delete from groups
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('user_groups') . " WHERE user_id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);

// delete from roles
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('user_roles') . " WHERE user_id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);

// delete from pools
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('pools_rel') . " WHERE principal_type = 1 AND principal_id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);

// delete from permissions
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('perms') . " WHERE principal_type = 1 AND principal_id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);

// delete from node permissions
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('node_perms') . " WHERE principal_type = 1 AND principal_id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);

// delete from users
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('users') . " WHERE id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);

// Update address
XT::query("UPDATE " . XT::getTable("addresses") . " SET user_id=NULL, is_primary_user_address=0 WHERE user_id=" . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);

XT::log("User " . $GLOBALS['plugin']->getValue('id') . " has been deleted.",__FILE__,__LINE__,XT_INFO);
?>