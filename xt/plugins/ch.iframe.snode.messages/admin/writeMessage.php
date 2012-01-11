<?php

// Add buttons
$GLOBALS['plugin']->contribute("write_buttons", "Send", "sendMessage","mail_out.png","writemessage");

// Set variables
XT::assign("RECEIVER", $GLOBALS['plugin']->getValue("receiver"));
XT::assign("MESSAGE_FLOW", $GLOBALS['plugin']->getValue("message_flow"));
XT::assign("SUBJECT", $GLOBALS['plugin']->getValue("subject"));
XT::assign("PARENT_ID", $GLOBALS['plugin']->getValue("id"));
XT::assign("MODE", $GLOBALS['plugin']->getValue("mode"));
XT::assign("TEXT", $GLOBALS['plugin']->getValue("text"));

// Fetch content
$content = XT::build("writeMessage.tpl");

?>