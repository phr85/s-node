<?php
// Parameter :: Style
$style = $GLOBALS['plugin']->getParam('style') != '' ? $GLOBALS['plugin']->getParam('style') : 'default.tpl';
if (XT::isLoggedIn() && XT::getPermission('selfmanage')) {
	
	if (XT::getValue("id") != "") {
		$andid = " AND id=" . XT::getValue("id");
	}
	
	$result = XT::query("
    SELECT
       *
    FROM
        " . XT::getTable('addresses') . "
    WHERE
	user_id = " . XT::getUserid() . $andid . "
    ",__FILE__,__LINE__);
	$data = XT::getQueryData($result);
	
	
	// Get countries
	$result = XT::query("
	    SELECT
	        country,
	        name
	    FROM 
	        " . XT::getTable('countries') . "
	    ORDER BY
	        name ASC
	",__FILE__,__LINE__);
	
	XT::assign("COUNTRIES",XT::getQueryData($result));
	
	// Get regions
	$result = XT::query("
	    SELECT
	        region,
	        name
	    FROM 
	        " . XT::getTable('countries_regions') . "
	    WHERE
	        country = '" . $data[0]['country'] . "'
	    ORDER BY
	        name ASC
	",__FILE__,__LINE__);
		
	XT::assign("REGIONS",XT::getQueryData($result));
	
	// Get system email
	$result = XT::query("
	    SELECT
	        email
	    FROM 
	        " . XT::getTable('user') . "
	    WHERE
	        id = '" . $data[0]['user_id'] . "'
	",__FILE__,__LINE__);
	if ($user_row = $result->FetchRow()) {
		$data[0]['system_email'] = $user_row['email'];
	}
	
	// Image
	XT::assign("IMAGE_PICKER_TPL", XT::getConfig("image_picker_tpl"));
	XT::assign("IMAGE_PICKER_BASE_ID", XT::getConfig("image_picker_base_id"));
	
	XT::assign("REQUIRED_FIELDS", XT::getConfig("required_fields"));
	XT::assign("DATA", $data[0]);
} else {
	$style = "login.tpl";
}

 $content = XT::build($style);
?>