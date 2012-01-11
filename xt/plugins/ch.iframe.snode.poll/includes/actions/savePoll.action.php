<?php

// Does the user allow multiple options?
if(XT::getValue("multiple")==1){
    $multiple = 1;
}else{
    $multiple = 0;
}

// Image Zoom enabled?
if(XT::getValue("image_zoom")==1){
    $image_zoom = 1;
}else{
    $image_zoom = 0;
}

// Convert date format: dd.mm.yy into unix timestamp
if(XT::getValue('polldate_str')!=""){
    $date_pre = explode(".",XT::getValue('polldate_str'));
    $polldate = mktime(0,0,0,$date_pre[1],$date_pre[0],$date_pre[2]);
}else{
    $polldate = 'NULL';
}

// Check if everything was entered.
$poll_title = XT::getValue('title');

if($poll_title == ""){
   		XT::actionStop(XT::translate("Please fill in the poll title"));
}
// perform Poll save operation
XT::query("
    UPDATE
        " . XT::getTable('poll') . "
    SET
        title = '" . XT::getValue('title') . "',
        date = " . $polldate . ",
        description = '" . XT::getValue('description') . "',
        mod_date = " . time() . ",
        mod_user = " . XT::getUserID() . ",
        image = '" . XT::getValue('image') . "',
        image_version = '" . XT::getValue('image_version') . "',
        image_zoom = '" . $image_zoom . "',
        multiple = '" . $multiple . "',
        lang = '" . XT::getActiveLang() . "',
        display_time_type ='" . XT::getValue('time_type') . "',
        display_time_start ='" . XT::getValue('sdate') . "',
        display_time_end ='" . XT::getValue('edate') . "'
    WHERE
        id = '" . XT::getValue('id') . "'
    AND
        lang = '" . XT::getActiveLang() . "'"
,__FILE__,__LINE__);


// Also save Answers...
$answer_titles = XT::getValue('option_title');

// If there are any answers.
if (is_array($answer_titles)){
	
	// If there was forgot 1 answer input field
	foreach ($answer_titles as $id=>$title){
		if($title == ""){
	   		XT::actionStop(XT::translate("Please fill in all Option Titles"));
		}		
	}
		// perform Answers save operation for all available answers
		foreach ($answer_titles as $id=>$title){
			XT::query("
			    UPDATE
			        " . XT::getTable('answers') . "
			    SET
			        title = '" . $title . "'
			    WHERE
			        id = '" . $id . "'
			    AND
			        lang = '" . XT::getActiveLang() . "'"
			,__FILE__,__LINE__);
		}
}
XT::setAdminModule("edit");

?>