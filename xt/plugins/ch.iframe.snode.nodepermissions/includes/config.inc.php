<?php

$GLOBALS['plugin']->setBaseID(150);


$GLOBALS['plugin']->addTable('node_perms','node_perms','node_perms ', false);
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


$GLOBALS['plugin']->addTab('mUser','mUser','mUser.php',false,false);
$GLOBALS['plugin']->addTab('mRole','mRole','mRole.php',false,false);
$GLOBALS['plugin']->addTab('mGroup','mGroup','mGroup.php',false,false);

$GLOBALS['plugin']->addTab('slave1','Slave1','slave1.php',false,false);
$GLOBALS['plugin']->addTab('s1User','s1User','s1User.php',false,false);
$GLOBALS['plugin']->addTab('s1Role','s1Role','s1Role.php',false,false);
$GLOBALS['plugin']->addTab('s1Group','s1Group','s1Group.php',false,false);



$GLOBALS['plugin']->enablePermissions();


$GLOBALS['plugin']->addContentType(3, "User");

?>
