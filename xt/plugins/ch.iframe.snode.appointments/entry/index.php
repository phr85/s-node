<?php

// Parameter :: URL
$url = XT::autoVal("url","R");

if ($url == null){
	XT::assign("xt" . xt::getBaseID() . "_error",(XT::translate("No URL given.")));
	$urlblank = true;
}

// Parameter :: style
$style = XT::getParam("style") != '' ? XT::getParam("style") : 'default.tpl';

if (!$urlblank){
	// Get Appointment Data
	$result = XT::query("
		Select
			*
		FROM
            " . XT::getTable('appointments') . "
		WHERE
			url = '" . $url . "'
		");

	$temp = XT::getQueryData($result);
	print_r($temp);
	$appointment = $temp[0];
	$appointment['selected_dates'] = unserialize($temp[0]['selected_dates']);

	// Get Selected Dates
	$dates = array();
	$i = 0;
	foreach ($appointment['selected_dates'] as $key => $value) {
		$temp[$i] = explode("_",$key);
		$dates[$i] = $temp[$i][0];
		$times[$i]['timestamp'] = $temp[$i][0];
		$times[$i]['number'] = $temp[$i][1];
		$times[$i]['value'] = $value;
		$i++;
	}
	$dates = array_unique($dates);

	/*
	// Select all entries.
	$result = XT::query("
	Select
	*
	FROM
	" . XT::getTable('appointments_entries') . " as e
	WHERE
	appointment_id = " . $appointment['id'] . "
	");
	*/
	$entries = XT::getQueryData($result);
}

xt::assign("xt" . xt::getBaseID() . "_appointment",$appointment);
XT::assign("xt" . XT::getBaseID() . "_dates", $dates);
XT::assign("xt" . XT::getBaseID() . "_times", $times);
xt::assign("xt" . xt::getBaseID() . "_entry",$entries);

$content = XT::build($style);

?>