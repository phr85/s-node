<?php
$data = array();
if (XT::getValue("startdate_str") != "" && XT::getValue("enddate_str") != "") {
	// calculate start date
	$start_tmp = explode(".",XT::getValue('startdate_str'));
	$start_date = mktime(0,0,0,$start_tmp[1],$start_tmp[0],$start_tmp[2]);
	// Calculate end date
	$end_tmp = explode(".",XT::getValue('enddate_str'));
	$end_date = mktime(23,59,59,$end_tmp[1],$end_tmp[0],$end_tmp[2]);

	// Ignore tickets which are still accounted
	if (XT::getValue("ignore_accounted")) {
		$ignore_accounted = "accounted=0 AND";
	}

	$result = XT::query("
		SELECT
			*
		FROM " . XT::getTable('tickets') . "
		WHERE
			status = 5 AND
			" . $ignore_accounted . "
			billable=1 AND
		mod_date BETWEEN " . $start_date . " AND " . $end_date . "
		ORDER BY mod_date ASC
	",__FILE__,__LINE__);

	$i = 0;
	 // Load csv class
	XT::loadClass('csv.class.php','ch.iframe.snode.core');
	// generete csv object
	$csv = new csv("ticket_accounting.csv");
	// Header
	$data[$i][0] = XT::translate("ID");
	$data[$i][1] = XT::translate("Title");
	$data[$i][2] = XT::translate("Last change");
	$data[$i][3] = XT::translate("Accounting status");
	$data[$i][4] = XT::translate("Description");
	$data[$i][5] = XT::translate("Client");
	$data[$i][6] = XT::translate("Effort");
	$data[$i][7] = XT::translate("Vorgabezeit");
	$data[$i][8] = XT::translate("Durch Kunde Geprüft");
	$data[$i][9] = XT::translate("Durch uns Geprüft");
	$data[$i][10] = XT::translate("Arbeit erledigt durch");
	$i++;
	while($row = $result->fetchRow()){
		// Fill the data array for the csv export
		$data[$i][0] = $row['id'];
		$data[$i][1] = $row['title'];
		$data[$i][2] = date("d.m.Y",$row['mod_date']);
		$data[$i][3] = $row['accounted'] == 1? XT::translate("accounted"):XT::translate("not accounted");
		$data[$i][4] = substr(strip_tags(str_replace("\n","-",$row['description'])),0,200);

		// Get all address data
		$result_address = XT::query("
		SELECT
			*
		FROM " . XT::getTable('addresses') . "
		WHERE
			 id='" . $row['client_id'] . "'
		",__FILE__,__LINE__);
		$row_address = $result_address->fetchRow();
		$data[$i][5] = $row_address['title'] . ";" . $row_address['firstName'] . " " . $row_address['lastName'] . ";". $row_address['street'] . ";" . $row_address['postalCode'] . " " . $row_address['city'] . ";" . xt_getcountry($row_address['country']) . ";" . $row_address['tel'] . ";". $row_address['email'];

		// Get efford
		$result_history = XT::query("
		SELECT
			*
		FROM " . XT::getTable('tickets_history') . "
		WHERE
			 ticket_id='" . $row['id'] . "' AND
			type=0
		",__FILE__,__LINE__);
		// Reset the effort
		$effort = 0;
		while($row_history = $result_history->fetchRow()){
			$effort = $effort + ($row_history['end_date'] - $row_history['start_date']);
		}
		$data[$i][6] = ceil($effort/60);
		$data[$i][7] = $row['work_time'];
		$data[$i][8] = $row['checked_by_client'] == 1 ? "Ja" : "";
		$data[$i][9] = $row['checked_by_supervisor'] == 1 ? "Ja" : "";
		$data[$i][10] = XT::getUserName($row['worker']);
		$i++;
		// mark assigned ticket as accounted
		if (XT::getValue("mark_accounted")){
			XT::query("
			UPDATE " . XT::getTable('tickets') . "
			SET
			accounted=1
			WHERE
				 id='" . $row['id'] . "'
			",__FILE__,__LINE__);
		}

	}
	$csv->data = $data;
//	XT::printArray($data);
	$csv->sendData();
	exit;
}
XT::setAdminModule('accounting');
?>