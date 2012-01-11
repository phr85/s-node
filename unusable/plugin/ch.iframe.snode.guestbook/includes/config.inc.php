<?php

// Set Base id
$GLOBALS['plugin']->setBaseID(1500);

// Plugin tables
$GLOBALS['plugin']->addTable('guestbook','guestbook','Guestbook main data', false);

// Basic Functions for realip
require_once(FUNC_DIR . 'basic.functions.php');

// Plugin admin tabs
$GLOBALS['plugin']->addTab('o','Overview','overview.php',true,true);
$GLOBALS['plugin']->addTab('eo','Settings','editSettings.php',false,true);
$GLOBALS['plugin']->addTab('ae','Add entry','addEntry.php',false,false);
$GLOBALS['plugin']->addTab('ee','Edit entry','editEntry.php',false,false);


// Plugin config variables
$GLOBALS['plugin']->addConfig('pagesplit','5','Entries per page');
$GLOBALS['plugin']->addConfig('badwordreplace','*bubble*','replace word');
$GLOBALS['plugin']->addConfig('htmltags','<b></b><i></i><u></u>','Allowed tags');
$GLOBALS['plugin']->addConfig('emoticonpath','/images/emoticons/','Emoticon imagepath');
$GLOBALS['plugin']->addConfig('emoticonlist',':-) => smile_regular.gif <= ;-) => smile_wink.gif <= :-( => smile_sad.gif','');

// Load permissions
$GLOBALS['plugin']->enablePermissions();

?>