<?php 

/* List */
/* Author: Ricardo de Sousa */

// Parameter :: Style
$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';

// Parameter :: Limit
$limit = XT::getParam('limit') != '' ? XT::getParam('limit') : '10';

// Parameter :: Viewer TPL
$data['viewertpl'] = XT::getParam('viewertpl');

$result = XT::query("
        SELECT
   		    *
    	FROM
        	" . XT::getTable('googlemaps') . " as m
    	LEFT JOIN
    		" . XT::getTable('googlemaps_lang') . " as maps_lang ON (m.id = maps_lang.map_id AND maps_lang.lang = '" . XT::getLang() . "')
    	WHERE
        	m.active = 1
        ORDER BY
        	m.c_date desc
        LIMIT
        	0, " . $limit . "        	
        "
, __FILE__, __LINE__);

$data['maps'] = XT::getQueryData($result);

if ($data['maps'][0] == ""){
		XT::assign("xt" . XT::getBaseID() . "_error", XT::translate("No active Maps found."));
}

XT::assign("xt" . XT::getBaseID() . "_list", $data);

$content = XT::build($style);

?>