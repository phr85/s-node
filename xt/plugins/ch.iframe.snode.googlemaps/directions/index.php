<?php

/* Directions */
/* Author: Ricardo de Sousa */

// Parameter :: Style
$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';

// Get ID
$addr_id = XT::autoval("addr_id","R");

// Get Main Map TPL
$viewertpl = XT::autoval("viewertpl","R");

// Google API Key
$key = XT::getConfig('api-key');

// If there was any address id given
if ($addr_id){
	$result_address = XT::query("
	        SELECT
	           	e.*,
	           	entries_lang.*,
		       	address.title as addr_title,
		       	address.street as addr_street,
		       	address.postalCode as addr_postalCode,
		       	address.city as addr_city
    		FROM
        		" . XT::getTable('googlemaps_entries') . " as e
    		LEFT JOIN
    			" . XT::getTable('googlemaps_entries_lang') . " as entries_lang ON (e.id = entries_lang.entry_id AND entries_lang.lang = '" . $GLOBALS['plugin']->getActiveLang() . "')
    		LEFT JOIN
    			" . XT::getTable("addresses") . " as address ON (e.addr_id = address.id)
    		WHERE
	        	e.active = 1
	        AND
	        	e.id = " . $addr_id .  "  	
	        "
,__FILE__,__LINE__);
	
	// Assign selected data
	$data['address'] = XT::getQueryData($result_address);
	$data['address'] = $data['address'][0];
	$data['key'] = $key;
	
	// If the address ID was given and correct, select crucial map data
	if ($data['address']['id']){
		$result = XT::query("
		        SELECT
   		    		*
    			FROM
        			" . XT::getTable('googlemaps') . " as m
    			LEFT JOIN
    				" . XT::getTable('googlemaps_lang') . " as maps_lang ON (m.id = maps_lang.map_id AND maps_lang.lang = '" . $GLOBALS['plugin']->getActiveLang() . "')
    			WHERE
    				m.active = 1
		        AND
		        	m.id = " . $data['address']['map_id'] .  " 
    			",__FILE__,__LINE__);
		
		// Assign selected data
		$data['map'] = XT::getQueryData($result);
		$data['map'] = $data['map'][0];
	}
	// If Address is not empty
	if ($data['address'] == ""){
		XT::assign("xt" . XT::getBaseID() . "_error", XT::translate("No Address found under the ID you provided. Please check your link."));
	}
}else{
	XT::assign("xt" . XT::getBaseID() . "_error", XT::translate("No Address ID number given. Please check your page / link."));
}

// Assign map viewer tpl
$data['viewertpl'] = $viewertpl;

// Assign Google Maps API Key
$data['key'] = $key;

// Assign data.
XT::assign("xt" . XT::getBaseID() . "_directions", $data);

$content = XT::build($style);

?>