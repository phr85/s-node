<?php

XT::setBaseID(3500);

XT::addTable('mail_head_body');
XT::addTable('mail_accounts');
XT::addTable('mail_folders');

XT::addTab('o','Overview','overview.php',true,true);
XT::addTab('v','View message','viewMessage.php',false,false);
XT::addTab('slave1','Slave1','slave1.php',false,false);
XT::addTab('slave2','Slave2','slave2.php',false,false);

XT::enablePermissions();

?>