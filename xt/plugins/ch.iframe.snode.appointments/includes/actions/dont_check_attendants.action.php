<?php

// Get Values that were entered before 
$inputvalues = XT::getSessionValue('inputvalues');

// Get Dates
$dates = XT::getSessionValue('userdata');

// See if User is re-posting.
$time = TIME - XT::getConfig('postTime');
$alreadyPostedTime = XT::getSessionValue('postTime');
if ($alreadyPostedTime < $time){
	// When is this entry going to get deleted by a cronjob?
	$end_date = time() + XT::getConfig('deleteTime');
	// Generate ID for this appointment
	$stringid = md5(microtime(false));

	$inputvalues['url'] = $stringid;

	// Was the geo-information entered? Any coordinates found?
	if ($inputvalues['city']){
		$query = XT::Query("
					INSERT INTO
						" . XT::getTable('appointments') . " (
						title,
						user_id,
						url,
						active,
						selected_times,
						date,
						end_date,
						email,
						lang,
						description,
						name,
						city,
						housenumber,
						street,
						latitude,
						longitude,
						attendants_invited
					)
					VALUES(
						'" . $inputvalues['title'] . "',
						'',
						'" . $stringid. "',
						1,
						'" . serialize($dates) . "',
						" . time() . ",
						" . $end_date . ",
						'" . $inputvalues['email'] . "',
			           	'" . XT::getActiveLang() . "',
						'" . $inputvalues['description'] . "',
						'" . $inputvalues['name'] . "',
						'" . $inputvalues['city'] . "',
						'" . $inputvalues['housenumber'] . "',
						'" . $inputvalues['street'] . "',
						" . $inputvalues['latitude'] . ",
						" . $inputvalues['longitude'] . ",
						''
					)
				");
	}else(
	$query = XT::Query("
					INSERT INTO
						" . XT::getTable('appointments') . " (
						title,
						user_id,
						url,
						active,
						selected_times,
						date,
						end_date,
						email,
						lang,
						description,
						name,
						city,
						housenumber,
						street,
						latitude,
						longitude,
						attendants_invited
					)
					VALUES(
						'" . $inputvalues['title'] . "',
						'',
						'" . $stringid. "',
						1,
						'" . serialize($dates) . "',
						" . time() . ",
						" . $end_date . ",
						'" . $inputvalues['email'] . "',
			           	'" . XT::getActiveLang() . "',
						'" . $inputvalues['description'] . "',
						'" . $inputvalues['name'] . "',
						'',
						'',
						'',
						'',
						'',
						''
					)
				")
				);
				XT::setSessionValue('postTime',TIME);
				XT::setValue('step','invite');
}else{
	XT::assign("ERRORS",XT::translate('You are posting too fast. Try again later.'));
	XT::setValue('step','invite');
}

XT::setValue('step','finish');

XT::setSessionValue("inputvalues",$inputvalues);

$content = XT::build('finish.tpl');

?>