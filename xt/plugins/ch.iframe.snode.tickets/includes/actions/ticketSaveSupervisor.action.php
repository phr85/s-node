<?php
// Save the work time
XT::call("saveWorkTime");

// Decide what to do if the worker was set or not
if (XT::getValue('worker') > 0) {
	if(XT::getValue('old_status') == 0) {
		XT::setValue("status",1);
	}
} else {
	XT::setValue("status",0);
	XT::setValue("worker",0);
}
// Save the status
XT::call("statusChange");
XT::call('addFile');
// Get the date and save the result
$tmp = explode(".",XT::getValue('date_str'));
$date = mktime(XT::getValue('hour'),XT::getValue('minute'),0,$tmp[1],$tmp[0],$tmp[2]);
$result = XT::query("
   UPDATE " . XT::getTable('tickets') . " SET 
		mod_user='" . XT::getUserID() . "',
		mod_date='" . time() . "',
		title='" . XT::getValue('title') . "',
		description='" . XT::getValue('description') . "',
		client_id='" . XT::getValue('client_id') . "',
		date='" 	. $date . "',
		priority='" . XT::getValue('priority') . "',
		mail_report='" . XT::getValue('mail_report') . "',
		client_check='" . XT::getValue('client_check') . "',
		work_time='" . XT::getValue('work_time') . "',
		supervisor='" . XT::getValue('supervisor') . "',
		supervisor_check='" . XT::getValue('supervisor_check') . "',
		worker='" . XT::getValue('worker') . "',
		billable='" . XT::getValue('billable') . "'
		WHERE id=" . XT::getValue('id') . "
", __FILE__, __LINE__);
XT::log(XT::translate('Ticket saved'),__FILE__,__LINE__,XT_INFO);
XT::setAdminModule('edit');
?>