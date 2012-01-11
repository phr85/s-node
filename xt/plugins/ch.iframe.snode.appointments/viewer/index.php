<?php

// Parameter :: Style
$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';

// Parameter :: URL
$url = XT::autoval('url', "R");

// Select all Votes.
$result = XT::query("
	Select
		*
	FROM
        " . XT::getTable('appointments') . " as e
	WHERE
		e.url = '" . $url . "'
	");

// Get Total Number of Votes for All Answers 
$temp = XT::getQueryData($result);

// Grab selected times 
$days = unserialize($temp[0]['selected_times']);
$temp[0]['selected_times'] = $days;

$frontDates = array();
$months = array();
// Go through each date and check out their time values
// Also select months that will be displayed

$selectedDates = array();
$frontDates = array();
$selectedDays = array();
$selectedHours = array();

if ($days){
	foreach ($days as $key => $date){
		// Get it apart
		$tempDays = explode("_",$key);
		// Save Days
		$selectedDays[$i] = $tempDays[0];
		// Save Times
		$selectedHours[$i] = $tempDays[1];
		
		$i++;
	}
	// Find out how many times have been added.
	$numberOfTimes = max($selectedHours);
	
	// Turn exploded array into unique days
	$selectedDays = array_unique($selectedDays);
	
	// Create Months
	$i = 0;
	foreach ($selectedDays as $days){
		$selectedDaysMonth[$i]['month'] = date("n",$days);
		$selectedDaysMonth[$i]['year'] = date("Y",$days);
		$selectedMonths[$i] = mktime(0,0,0,$selectedDaysMonth[$i]['month'],1,$selectedDaysMonth[$i]['year']);
		$i++;
	}
	
	$months = array_unique($selectedMonths);
	
}else{
		XT::assign("ERRORS",XT::translate('false input given'));
}



// How many rows did the creator fill out with times?
$numberOfDays = count($frontDates);

$data['months'] = $months;
$data['appointmentData'] =  $temp[0];
$data['frontDates'] =  $frontDates;
$data['numberOfTimes'] =  $numberOfTimes;

XT::assign("xt" . XT::getBaseID() . "_viewer", $data);

$content = XT::build($style);

?>