<?php

// Grab inputfields
$invites = XT::getValues('invites');
$inputvalues = XT::getSessionValue('inputvalues');
$userdata = XT::autoVal('userdata',"S");

// Get Dates
$dates = XT::getSessionValue('userdata');
print_r($dates );

// Always assume that input is wrong
$mailok = false;

// How many attendants were posted?
$attendantCount =  count($invites['attendant']);

// If there was anything posted go on.
if ($attendantCount > 0){
	$attendants = array();
	$i = 0;
	foreach ($invites['attendant'] as $attendant){
		$attendants[$i]['value'] = $attendant;
		// If this array entry is not empty, feel free to check the mail.
		if ($attendant != ""){
			// Is mail ok?
			if (preg_match('/^.+@.+\..+$/',$attendant)){
				$mailok = true;
				$attendantsInvited[$i]= $attendant;
			}else{
				$attendants[$i]['error'] = true;
				$mailok = false;
				$someMailFalse = true;
				XT::assign("ERRORS",XT::translate('false input given'));
			}
		}else{
			// If it is empty, lets register it!
			$empty++;
		}
		$i++;
	}
	// If every field is empty, tell the user.
	if ($empty == $attendantCount){
		$mailok = false;
		XT::assign("ERRORS",XT::translate('no input given'));
	}
}else{
	$mailok = false;
	XT::assign("ERRORS",XT::translate('If you want to invite someone, please enter the e-mail address.'));
}

// If mail is real and if there is any attendant, post it!
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
							url,
							active,
							selected_times
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
							'" . serialize($attendantsInvited) . "'
						)
					");
		}else(
		$query = XT::Query("
						INSERT INTO
							" . XT::getTable('appointments') . " (
							title,
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
							'" . serialize($attendantsInvited) . "'
						)
					")
					);
					XT::setSessionValue('postTime',TIME);
					//
					XT::setValue('step','invite');

	}else{
		XT::assign("ERRORS",XT::translate('You are posting too fast. Try again later.'));
		XT::setValue('step','invite');
	}

XT::setValue('step','invite');

$data = array();
$data['attendantCount'] = $attendantCount;
$data['attendants'] = $attendants;

XT::assign("xt" . XT::getBaseID() . "_add", $data);

$content = XT::build('finish.tpl');

?>