<?php
$GLOBALS['plugin']->setBaseID(100);

$GLOBALS['plugin']->addTable('pools','security_pools','Security pools', false);
$GLOBALS['plugin']->addTable('pools_details','security_pools_details','Security pools details', false);
$GLOBALS['plugin']->addTable('pools_rel','security_pools_rel','Security pools rel', false);
//Groups
$GLOBALS['plugin']->addTable('groups','groups','groups', false);
//Roles
$GLOBALS['plugin']->addTable('roles','roles','roles', false);
$GLOBALS['plugin']->addTable('group_roles','group_roles','group_roles', false);
//Users
$GLOBALS['plugin']->addTable('users','user','user', false);
$GLOBALS['plugin']->addTable('user_roles','user_roles','user_roles', false);
$GLOBALS['plugin']->addTable('user_groups','user_groups','user_groups', false);

$GLOBALS['plugin']->addTable('addresses','addresses','addresses',false);
$GLOBALS['plugin']->addTable('newsletter_subscriptions','newsletter_subscriptions','Subscriptions',false);

//Permissions (for the delete actions)
$GLOBALS['plugin']->addTable('node_perms','node_perms','node_perms ', false);
$GLOBALS['plugin']->addTable('perms','perms','perms ', false);

$GLOBALS['plugin']->addTab('o','Overview','overview.php',true,true);
$GLOBALS['plugin']->addTab('slave1','Slave1','slave1.php',false,false);
$GLOBALS['plugin']->addTab('slave2','Slave2','slave2.php',false,false);
$GLOBALS['plugin']->addTab('s2Pool','users in Pool','s2Pool.php',false,false);
$GLOBALS['plugin']->addTab('s2Role','users in Role','s2Role.php',false,false);
$GLOBALS['plugin']->addTab('s2Group','users in Group','s2Group.php',false,false);
$GLOBALS['plugin']->addTab('s2AddGroup2Role','Add group 2 Role','s2AddGroup2Role.php',false,false);
$GLOBALS['plugin']->addTab('s2AddUser2Role','Add user 2 Role','s2AddUser2Role.php',false,false);
$GLOBALS['plugin']->addTab('s2AddUser2Group','Add user 2 Group','s2AddUser2Group.php',false,false);
$GLOBALS['plugin']->addTab('s1EditRole','Edit role','s1EditRole.php',false,false);
$GLOBALS['plugin']->addTab('s1EditGroup','Edit group','s1EditGroup.php',false,false);
$GLOBALS['plugin']->addTab('s1EditUser','Edit user','s1EditUser.php',false,false);
$GLOBALS['plugin']->addTab('s1CreateUser','Create user','s1CreateUser.php',false,false);
$GLOBALS['plugin']->addTab('userManagement','Manage users','Usermanagement.php',false,true);
$GLOBALS['plugin']->addTab('groupManagement','Manage groups','Groupmanagement.php',false,true);
$GLOBALS['plugin']->addTab('roleManagement','Manage roles','Rolemanagement.php',false,true);


$GLOBALS['plugin']->addTab('editPool','Edit Pool','editPool.php',false,false);
$GLOBALS['plugin']->addTab('roles','roles','roles.php',false,false);
$GLOBALS['plugin']->addTab('groups','groups','groups.php',false,false);
$GLOBALS['plugin']->addTab('users','users','users.php',false,false);

$GLOBALS['plugin']->addTab('dp','pool details','s1Pools.php',false,false);
$GLOBALS['plugin']->addTab('dr','role details','s1Roles.php',false,false);
$GLOBALS['plugin']->addTab('dg','groups details','s1Groups.php',false,false);
$GLOBALS['plugin']->addTab('du','users details','s1Users.php',false,false);

$GLOBALS['plugin']->enablePermissions();

// Image picker
$GLOBALS['plugin']->addConfig("image_picker_base_id", 240, "");
$GLOBALS['plugin']->addConfig("image_picker_tpl", 597, "");


$GLOBALS['plugin']->addConfig("infomailOnRegistration", false, "");

$GLOBALS['plugin']->addConfig("condition",'$condition = true;'); // A string parsed with eval. The registration only work if $condition is true

$GLOBALS['plugin']->addContentType(3, "User");

?>
