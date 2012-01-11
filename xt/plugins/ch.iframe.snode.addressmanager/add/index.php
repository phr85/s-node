<?php
// Parameter :: Style
$style = $GLOBALS['plugin']->getParam('style') != '' ? $GLOBALS['plugin']->getParam('style') : 'default.tpl';
if (XT::isLoggedIn() && XT::getPermission('selfmanage')) {
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
	XT::assign("REQUIRED_FIELDS", XT::getConfig("required_fields"));
	// Image
	XT::assign("IMAGE_PICKER_TPL", XT::getConfig("image_picker_tpl"));
	XT::assign("IMAGE_PICKER_BASE_ID", XT::getConfig("image_picker_base_id"));

	XT::assign("DATA",XT::getValues());

} else {
	$style = "login.tpl";
}


 $content = XT::build($style);
?>