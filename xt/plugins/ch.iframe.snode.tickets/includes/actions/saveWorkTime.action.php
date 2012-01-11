<?php
// Add a new timestamp
if (XT::getValue("comment") != "" && XT::getValue("work_time_add") > 0) {
	// The time
	$now = time();
	// Insert record
	XT::query("
    INSERT INTO
        " . XT::getTable('tickets_history') . "
   (ticket_id,type,start_date,end_date,worker,description) VALUES (
	" . XT::getValue("id") . ",
	0,
	" . ($now - (60*XT::getValue("work_time_add"))) . ",
	" . $now . ",
	" . XT::getUserId() . ",
	'" . XT::getValue("comment") . "'
	)
	", __FILE__, __LINE__);
}
?>