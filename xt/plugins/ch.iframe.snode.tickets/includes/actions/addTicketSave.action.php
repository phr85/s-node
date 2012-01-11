<?php
// The status is open (0) by default
$status = 0;

if (XT::getValue('worker') > 0) {
	// If a worker is defined, the status is running and the ticket is not in the pool
	$status = 1;
}

// The actual timestampt for the creation date
$now = time();

// generate the date
$tmp = explode(".",XT::getValue('date_str'));
$date = mktime(XT::getValue('hour'),XT::getValue('minute'),0,$tmp[1],$tmp[0],$tmp[2]);
// Insert the ticket
$result = XT::query("
    INSERT INTO " . XT::getTable('tickets') . "
        (
		creation_user,
		creation_date,
		mod_user,
		mod_date,
		title,
		description,
		client_id,
		date,
		priority,
		mail_report,
		client_check,
		work_time,
		billable,
		supervisor,
		supervisor_check,
		worker,
		status
		)
		VALUES (
		'" . XT::getUserID() . "',
		'" . $now . "',
		'" . XT::getUserID() . "',
		'" . $now. "',
		'" . XT::getValue('title') . "',
		'" . XT::getValue('description') . "',
		'" . XT::getValue('client_id') . "',
		'" . $date . "',
		'" . XT::getValue('priority') . "',
		'" . XT::getValue('mail_report') . "',
		'" . XT::getValue('client_check') . "',
		'" . XT::getValue('work_time') . "',
		'" . XT::getValue('billable') . "',
		'" . XT::getValue('supervisor') . "',
		'" . XT::getValue('supervisor_check') . "',
		'" . XT::getValue('worker') . "',
		'" . $status	 . "'
		)
", __FILE__, __LINE__);

// Get the new id 
$result = XT::query("
    SELECT
       *
    FROM
        " . XT::getTable('tickets') . "
    WHERE
		creation_date=" . $now . "
",__FILE__,__LINE__);
$row = $result->fetchRow();
$ticket_id = $row['id'];
XT::setValue('id',$ticket_id);
XT::call('addFile');
XT::log(XT::translate('Ticket added'),__FILE__,__LINE__,XT_INFO);
XT::setAdminModule('addTicket');
?>