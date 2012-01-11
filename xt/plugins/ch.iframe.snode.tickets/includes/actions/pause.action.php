<?php
if ($_SESSION['timer'][XT::getValue("ticket_id")]['last_update'] != false){
	// If the timer is running calculate the duration since the last update and add the time to the timer
	$_SESSION['timer'][XT::getValue("ticket_id")]['time'] = $_SESSION['timer'][XT::getValue("ticket_id")]['time'] + (time() - $_SESSION['timer'][XT::getValue("ticket_id")]['last_update']);	
}
$_SESSION['timer'][XT::getValue("ticket_id")]['status'] = 2;
?>