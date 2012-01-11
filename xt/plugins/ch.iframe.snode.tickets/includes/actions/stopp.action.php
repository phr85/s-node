<?php

if ($_SESSION['timer'][XT::getValue("ticket_id")]['last_update'] != false){
	// If the timer is running calculate the duration since the last update and add the time to the timer
	//$_SESSION['timer'][XT::getValue("ticket_id")]['time'] = $_SESSION['timer'][XT::getValue("ticket_id")]['time'] + (time() - $_SESSION['timer'][XT::getValue("ticket_id")]['last_update']);	
}

$now = time();
$tmp_comment = XT::getValue("comment");
// Insert record
XT::query("
INSERT INTO
    " . XT::getTable('tickets_history') . "
   (ticket_id,type,start_date,end_date,worker,description) VALUES (
	" . XT::getValue("ticket_id") . ",
0,
" . (time() - $_SESSION['timer'][XT::getValue("ticket_id")]['time']). ",
" . time() . ",
" . XT::getUserId() . ",
'" . $tmp_comment[XT::getValue("ticket_id")] . "'
)
", __FILE__, __LINE__);
$tmp_comment[XT::getValue("ticket_id")] = "";
XT::setValue("comment",$tmp_comment);
$_SESSION['timer'][XT::getValue("ticket_id")]['status'] = 0;
$_SESSION['timer'][XT::getValue("ticket_id")]['time'] = 0;
$_SESSION['timer'][XT::getValue("ticket_id")]['last_update'] = false;
?>