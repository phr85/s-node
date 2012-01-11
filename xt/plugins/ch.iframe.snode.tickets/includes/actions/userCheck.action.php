<?php
// Set the new status
XT::query("
UPDATE
    " . XT::getTable('tickets') . "
SET checked_by_client=1 WHERE id=" . XT::getValue('id') . "
", __FILE__, __LINE__);

$now = time();
XT::query("
INSERT INTO
    " . XT::getTable('tickets_history') . "
   (ticket_id,type,start_date,end_date,worker,description) VALUES (
	" . XT::getValue("id") . ",
1,
" . $now . ",
" . $now . ",
" . XT::getUserId() . ",
'" . XT::translate("Client approved this ticket") . "'
)
", __FILE__, __LINE__);
?>