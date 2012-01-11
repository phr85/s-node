<?php

// Set Base id
$GLOBALS['plugin']->setBaseID(1500);

// Plugin tables
$GLOBALS['plugin']->addTable('guestbook','guestbook','Guestbook main data', false);

// Basic Functions for realip
require_once(FUNC_DIR . 'basic.functions.php');

// Plugin admin tabs
$GLOBALS['plugin']->addTab('o','Overview','overview.php',true,true);
$GLOBALS['plugin']->addTab('ee','Edit entry','editEntry.php',false,false);

// moderator email address
XT::addConfig("moderate", $GLOBALS['cfg']->get('system','email'), "Use this email to moderate comments. A blank value disable the moderation function.");

// Plugin config variables
$GLOBALS['plugin']->addConfig('insertActive','1','Entries activated per default');
$GLOBALS['plugin']->addConfig('pagesplit','10','Entries per page');
$GLOBALS['plugin']->addConfig('htmltags','<b></b><i></i><u></u>','Allowed tags');

// Load permissions
$GLOBALS['plugin']->enablePermissions();

?>