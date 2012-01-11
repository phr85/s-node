<?php
//delete users from groups
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('user_roles') . " WHERE role_id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);

// delete from roles
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('group_roles') . " WHERE role_id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);

// delete from pools
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('pools_rel') . " WHERE principal_type = 3 AND principal_id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);

// delete from permissions
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('perms') . " WHERE principal_type = 3 AND principal_id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);

// delete from node permissions
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('node_perms') . " WHERE principal_type = 3 AND principal_id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);

// delete from groups
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('roles') . " WHERE id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);

?>