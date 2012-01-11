<?php
// Parameter :: Style
$style = $GLOBALS['plugin']->getParam('style') != '' ? $GLOBALS['plugin']->getParam('style') : 'default.tpl';

if (XT::getValue("id") != "") {
	$id = XT::getValue("id");
	$result = XT::query("
	SELECT
	   *
	FROM
	    " . XT::getTable('addresses') . "
	WHERE
	id = " . $id . "
	",__FILE__,__LINE__);
	$data = XT::getQueryData($result);
	XT::assign("DATA", $data[0]);
} else {
	$id = XT::getUserid();
	$result = XT::query("
	SELECT
	   *
	FROM
	    " . XT::getTable('addresses') . "
	WHERE
	user_id = " . $id . "
	",__FILE__,__LINE__);
	$data = XT::getQueryData($result);
	XT::assign("DATA", $data[0]);
}




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


 
 $content = XT::build($style);
?>
