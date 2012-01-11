<?php
if(is_array(XT::getValue("message_ids"))){
	$message = new XT_Message();
	foreach (XT::getValue("message_ids") as $id) {
		$message->set_readed($id);
	}
}
?>