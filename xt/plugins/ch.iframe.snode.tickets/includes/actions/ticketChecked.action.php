<?php
XT::call("saveWorkTime");
XT::query("
    UPDATE
        " . XT::getTable('tickets') . "
  	SET checked_by_supervisor=1, status=5 WHERE id=" . XT::getValue('id') . "
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
'" . XT::translate('Supervisor approved this ticket') . "')"
,__FILE__,__LINE__);
XT::setAdminModule('edit');
?>