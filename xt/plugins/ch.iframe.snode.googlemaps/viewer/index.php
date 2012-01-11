<?php

/* Viewer */
/* Author: Ricardo de Sousa */

// Parameter :: Style
$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';

// Get ID
$map_id = XT::autoval("id","R");

// Get List TPL
$listtpl = XT::autoval("listtpl","P");

// Get Direction TPL
$directiontpl = XT::autoval("directiontpl","R");

// Get Width
$width = XT::autoval("width","R");

// Get Height
$height = XT::autoval("height","R");

// Google API Key
$key = XT::getConfig('api-key');

if ($map_id){
	$result = XT::query("
	        SELECT
   		    	*
    		FROM
        		" . XT::getTable('googlemaps') . " as m
    		LEFT JOIN
    			" . XT::getTable('googlemaps_lang') . " as maps_lang ON (m.id = maps_lang.map_id AND maps_lang.lang = '" . XT::getLang() . "')
			WHERE
	        	m.active = 1
	        AND
	        	m.id = " . $map_id .  "  	
	        "
	, __FILE__, __LINE__);
	
	$data['map'] = XT::getQueryData($result);
	$data['map'] = $data['map'][0];
	
	if ($data['map'] == ""){
		XT::assign("xt" . XT::getBaseID() . "_error", XT::translate("No Map found under the ID you provided. Please check your link."));
	}
		
	$result_address = XT::query("
	        SELECT
	        	*
		    FROM
		        " . XT::getTable('googlemaps_entries') . " as e
		    LEFT JOIN
		    	" . XT::getTable('googlemaps_entries_lang') . " as entries_lang ON (e.id = entries_lang.entry_id AND entries_lang.lang = '" . XT::getLang(). "')
		   	WHERE
	        	e.active = 1
	        AND
	        	e.map_id = " . $map_id .  "  
	        "
	, __FILE__, __LINE__);
	
	$data['address'] = XT::getQueryData($result_address);
	$data['key'] = $key;
}else{
	XT::assign("xt" . XT::getBaseID() . "_error", XT::translate("No Map ID number given. Please check your page / link."));
}

switch ($data['map']['type']){
	case 1:
		$maptype = "G_NORMAL_MAP";
		break;
	case 2:
		$maptype = "G_SATELLITE_MAP";
		break;
	case 3:
		$maptype = "G_HYBRID_MAP";
		break;
	case 4:
		$maptype = "G_PHYSICAL_MAP";
		break;
	default:
		$maptype = "G_NORMAL_MAP";
	;
}

$data['map']['type'] = $maptype;
$data['map']['directiontpl'] = $directiontpl;
$data['map']['listtpl'] = $listtpl;
$data['map']['width'] = $width;
$data['map']['height'] = $height;

XT::assign("xt" . XT::getBaseID() . "_viewer", $data);

$content = XT::build($style);

?>