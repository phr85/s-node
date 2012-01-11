<?php
require_once(CLASS_DIR . 'message.class.php');
$message = new XT_Message();
$message->addReceivers($GLOBALS['plugin']->getValue("receiver"));
$message->setMessageFlow($GLOBALS['plugin']->getValue("message_flow"));
$message->setParentMessage($GLOBALS['plugin']->getValue("parent_id"));
$message->send(
    $GLOBALS['plugin']->getValue("subject"),
    $GLOBALS['plugin']->getValue("text"),
    $GLOBALS['plugin']->getValue("priority")
);

$GLOBALS['plugin']->setAdminModule('slave1');
?>