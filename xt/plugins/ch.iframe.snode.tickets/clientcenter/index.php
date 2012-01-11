<?php

// calculate the difference between two timestamps
function timediff($date1,$date2) {
	if ($date1 > $date2) {
		$datediff = $date1 - $date2;
	} else {
		$datediff = $date2 - $date1;
	}
	$return['datediff'] = $datediff;
	$return['hours'] = floor($datediff/(60*60));
	$newdatediff = ($datediff - ($return['hours']*(60*60)));
	$return['minutes'] = floor($newdatediff/60);
	return $return;
}

function getAddressIdByUserId($user_id) {
		$result = XT::query("SELECT * FROM " .  XT::getDatabasePrefix() . "addresses WHERE user_id=" . $user_id,__FILE__,__LINE__);
		if($row = $result->FetchRow()){
			return $row['id'];
		} else {
			return false;
		}
}

// Parameter :: Style
$style = $GLOBALS['plugin']->getParam('style') != '' ? $GLOBALS['plugin']->getParam('style') : 'default.tpl';

$data = array();
// Get all associated addresses for the user id 
$result = XT::query("SELECT
       *
    FROM
        " . XT::getTable('addresses') . "
	WHERE 
		user_id=" . XT::getUserId() . " and active=1
    ",__FILE__,__LINE__);
$adresses = "";
while($row = $result->fetchRow()) {
	$data['adresses'][$row['id']] = $row;
	$adresses .=  "," . $row['id'];
}
$adresses = substr($adresses,1);
if ($adresses != "") {
	
	// Get all associated tickets for the user id 
	$result = XT::query("SELECT
	       *
	    FROM
	        " . XT::getTable('tickets') . "
		WHERE 
			client_id IN(" . $adresses . ") AND status=1
	    ORDER BY
	        date ASC
	    ",__FILE__,__LINE__);
	while($row = $result->fetchRow()) {
		$row['worker_address'] = getAddressIdByUserId($row['worker']);
		$row['supervisor_address'] = getAddressIdByUserId($row['supervisor']);
		
		$data['employer_on_running_tickets'][$row['worker']] = getAddressIdByUserId($row['worker']);
		$data['employer_on_running_tickets'][$row['supervisor']] = getAddressIdByUserId($row['supervisor']);
		$row['time_left'] = timediff(time(),$row['date']);
		$data['running'][$row['id']] = $row;
	}
	
	$result = XT::query("SELECT
	       *
	    FROM
	        " . XT::getTable('tickets') . "
		WHERE 
			client_id IN(" . $adresses . ") AND status=5
	    ORDER BY
	        date ASC
		LIMIT 0,5
	    ",__FILE__,__LINE__);
	while($row = $result->fetchRow()) {
		$row['worker_address'] = getAddressIdByUserId($row['worker']);
		$row['supervisor_address'] = getAddressIdByUserId($row['supervisor']);
		$data['closed'][$row['id']] = $row;
	}
	
	$result = XT::query("SELECT
	       *
	    FROM
	        " . XT::getTable('tickets') . "
		WHERE 
			client_id IN(" . $adresses . ") AND status=5 AND client_check=1 AND checked_by_client=0
	    ORDER BY
	        date ASC
	    ",__FILE__,__LINE__);
	while($row = $result->fetchRow()) {
		$row['worker_address'] = getAddressIdByUserId($row['worker']);
		$row['supervisor_address'] = getAddressIdByUserId($row['supervisor']);
		$data['unchecked'][$row['id']] = $row;
	}
	
	// Assign the all data
	XT::assign("xt" . XT::getBaseID() . "_clientcenter", $data);
	$content = XT::build($style);
} else {
	$content = XT::translate("There are no data available.");
}
?>
