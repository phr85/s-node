<?php
// modes: inbox_new, inbox, outbox, wastebasket
$mode = XT::autoval("mode","R","new");
$items_per_page = XT::getConfig("items_per_page");


$page_limiter = XT::getSessionValue('pagelimiter');
if(XT::getValue('page')){
	$page = XT::getValue('page');
	if(is_array($page_limiter)){
	$page_limiter = array_merge($page_limiter,$page);
	}else {
		$page_limiter = $page;
	}
}

$page_order =  XT::autoval("order","R");
 

if(!XT::getParam('is_controller')){
	switch ($mode) {
		case "inbox_new":
			$data = $XTMSG->get_received(null,true,$items_per_page,$page_limiter['inbox_new']);
			XT::setSessionValue("return_to_mode",$mode);
			break;
		case "inbox":
			$data = $XTMSG->get_received(null,false,$items_per_page,$page_limiter['inbox']);
			XT::setSessionValue("return_to_mode",$mode);
			break;
		case "outbox":
			$data = $XTMSG->get_sent(null,$items_per_page,$page_limiter['outbox']);
			XT::setSessionValue("return_to_mode",$mode);
			break;
		case "wastebasket":
			$data = $XTMSG->get_deleted(null,$items_per_page,$page_limiter['wastebasket']);
			XT::setSessionValue("return_to_mode",$mode);
			break;
		case "write":
			$data['write'] =XT::getValue("newmsg");
			break;
		case "read":
			$data['message'] = $XTMSG->read_message(XT::getValue("message_id"));
			if(XT::getValue("action")!="setMessageAsUnreaded"){
				$XTMSG->set_readed(XT::getValue("message_id"));
			}
			break;
		case "read_deleted":
			$data['message'] = $XTMSG->read_message(XT::getValue("message_id"));
			break;
		case "reply":
			$data['message'] = $XTMSG->read_message(XT::getValue("message_id"));

			break;
		default:
			$mode = "unsupported mode {$mode}";
			break;
	}
}
$data['mode'] = $mode;
$data['return_to_mode'] = XT::getSessionValue("return_to_mode");

// save values
XT::setSessionValue("pagelimiter",$page_limiter);
XT::setSessionValue("order",$page_order);

XT::assign("xt" . XT::getBaseID() . "_comp_messages",$data);

$content = XT::build(XT::autoval("style","P","default.tpl"));

?>