<?php
$_SESSION['timer'][XT::getValue("ticket_id")]['status'] = 1;
$_SESSION['timer'][XT::getValue("ticket_id")]['time'] = 0;
$_SESSION['timer'][XT::getValue("ticket_id")]['last_update'] = time();
?>