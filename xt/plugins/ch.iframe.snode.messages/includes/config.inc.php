<?php
// Set Base id
$GLOBALS['plugin']->setBaseID(50);

// Plugin tables
$GLOBALS['plugin']->addTable('messages','messages','Main messages table', false);
$GLOBALS['plugin']->addTable('user','user','Main user data', false);

// Plugin admin tabs
$GLOBALS['plugin']->addTab('o','Received messages','overview.php',true,true);
$GLOBALS['plugin']->addTab('sm','Sent messages','sentMessages.php',false,true);
$GLOBALS['plugin']->addTab('rm','Read message','readMessage.php',false,false);
$GLOBALS['plugin']->addTab('wm','Write message','writeMessage.php',false,false);
$GLOBALS['plugin']->addTab('slave1','Slave1','slave1.php',false,false);

$GLOBALS['plugin']->enablePermissions();

XT::addConfig("items_per_page",10);


// needed classes
XT::loadClass("message.class.php","ch.iframe.snode.messages");
// build object
$XTMSG = new XT_Message();

?>