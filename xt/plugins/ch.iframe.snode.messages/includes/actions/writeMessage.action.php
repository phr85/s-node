<?php
$values = XT::getValue("newmsg");
// check recipient
$to = XT::getQueryData(XT::query("SELECT id from xt_user where id='{$values['to']}' OR username='{$values['to']}'",__FILE__,__LINE__));
	
if($to[0]['id']){
	if($values['subject'] && $values['text']){
		$XTMSG = new XT_Message();
		$XTMSG->send_quick_message($to[0]['id'],$values['subject'] , $values['text']);
		XT::setValue("mode",XT::getSessionValue("return_to_mode"));
	}
}else {
	XT::actionStop("Recepient not found");
}
?>