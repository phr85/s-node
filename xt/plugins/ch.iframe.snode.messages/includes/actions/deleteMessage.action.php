<?php

$message = new XT_Message();
foreach (XT::getValue("message_ids") as $id) {
 	$message->delete_received($id);
 	$message->delete_sent($id);
} 
XT::setValue("mode","read_deleted");

?>