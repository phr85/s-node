<?php

/* Address List */
/* Author: Ricardo de Sousa */

// Parameter :: Style
$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';

// Get ID
$map_id = XT::autoval("id","R");

// Get Main Map TPL
$directiontpl = XT::autoval("directiontpl","R");

// Google API Key
$key = XT::getConfig('api-key');

if ($map_id){
	// If the address ID was given and correct, select crucial map data
	$result = XT::query("
		SELECT
   		    *
    	FROM
        	" . XT::getTable('googlemaps') . " as m
    	LEFT JOIN
    		" . XT::getTable('googlemaps_lang') . " as maps_lang ON (m.id = maps_lang.map_id AND maps_lang.lang = '" . XT::getLang() . "')
    	WHERE
        	m.id = " . $map_id . "
    	",__FILE__,__LINE__);
		
		$data['map'] = XT::getQueryData($result);
		$data['map'] = $data['map'][0];
		
	// If there was any data retreived, get every single address that is active. If not, tell the user.
	if ($data['map'] == ""){
		XT::assign("xt" . XT::getBaseID() . "_error", XT::translate("No Address found under the ID you provided. Please check your link."));
	}else{
		//Get addresses related to given map id and order it by position given in admin module
		$result_address = XT::query("
		        SELECT
		            *
    			FROM
        			" . XT::getTable('googlemaps_entries') . " as e
    			LEFT JOIN
    				" . XT::getTable('googlemaps_entries_lang') . " as entries_lang ON (e.id = entries_lang.entry_id AND entries_lang.lang = '" . XT::getLang() . "')
    			WHERE
		        	e.active = 1
		        and
        			e.map_id = " . $data['map']['id'] .  "       
       			ORDER BY
        			e.position ASC	
    			",__FILE__,__LINE__);
		
		$data['address'] = XT::getQueryData($result_address);
		$data['address'] = $data['address'];
		
		// If SQL select was empty, tell user. If not, proceed...
		if ($data['address'] == ""){
			XT::assign("xt" . XT::getBaseID() . "_error", XT::translate("No active addresses found under the map you provided. Please check your link."));
		}
	}
}else{
	XT::assign("xt" . XT::getBaseID() . "_error", XT::translate("No Map ID number given. Please check your page / link."));
}

// Direction tpl assign.
$data['directiontpl'] = $directiontpl;

// Assign Google Maps API Key
$data['key'] = $key;

// Assign $data variable to template.
XT::assign("xt" . XT::getBaseID() . "_address_list", $data);

$content = XT::build($style);

?>