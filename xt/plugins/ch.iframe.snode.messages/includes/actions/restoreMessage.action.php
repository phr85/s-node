<?php

$message = new XT_Message();
foreach (XT::getValue("message_ids") as $id) {
 	$message->undelete_received($id);
 	$message->undelete_sent($id);
} 
XT::setValue("mode","read");

?>