<?php
$errors = array();
// Check input
if (XT::getValue('title') == "") {
	$errors[] = "No title set!";
}

if (XT::getValue('description') == "") {
	$errors[] = "No description set!";
}

// generate the date
$tmp = explode(".",XT::getValue('date_str'));
$date = mktime(XT::getValue('hour'),XT::getValue('minute'),0,$tmp[1],$tmp[0],$tmp[2]);
XT::setValue("date",$date);
if ($date < time()) {
	$errors[] = "Ticket ends in the past!";
}
if (count($errors) == 0){ 
	
	if (XT::getConfig("auto_supervisor") != 0) {
		$status = 1;
	} else {
		$status = 0;
	}
	
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
			supervisor,
			supervisor_check,
			worker,
			status
			) 
			VALUES (
			'" . XT::getUserID() . "',
			'" . time() . "',
			'" . XT::getUserID() . "',
			'" . time() . "',
			'" . XT::getValue('title') . "',
			'" . XT::getValue('description') . "',
			'" . XT::getValue('client_id') . "',
			'" . $date . "',
			'" . XT::getValue('priority') . "',
			'" . XT::getValue('mail_report') . "',
			'" . XT::getValue('client_check') . "',
			'" . XT::getValue('work_time') . "',
			'" . XT::getConfig("auto_supervisor") . "',
			'0',
			'" . XT::getConfig("auto_supervisor") . "',
			'" . $status . "'
			)
	", __FILE__, __LINE__);
	XT::setValue("title","");
	XT::setValue("description","");
	XT::setValue("priority","");
	XT::setValue("mail_report","");
	XT::setValue("client_check","");
	XT::setValue("work_time","");
	XT::setValue("date","");
	
	XT::setValue("ticket_added",1);
	if (XT::getParam("redirect_tpl") != "") {
		header("Location: index.php?TPL=" . XT::getParam("redirect_tpl"));
		exit;
	}
}
XT::setValue("errors",$errors);
?>