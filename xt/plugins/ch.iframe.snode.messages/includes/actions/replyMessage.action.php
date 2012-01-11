<?php
$reply = XT::getValue("reply");
$XTMSG = new XT_Message();
$XTMSG->setMessageFlow($reply['msgflow']);
$XTMSG->addReceiver($reply['to']);
$XTMSG->send($reply['subject'],$reply['text']);
XT::setValue("mode",XT::getSessionValue("return_to_mode"));
?>