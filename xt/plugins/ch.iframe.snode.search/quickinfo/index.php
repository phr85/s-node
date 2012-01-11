<?php

// Parameter :: Style
$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';

if (XT::getParam('cid') != "" AND XT::getParam('ctype') != "") {

	// Get all pages
	$result = XT::query("
	    SELECT
	        a.*,
	        b.open_url
	    FROM
	        " . XT::getTable('search_infos_global') . " as a LEFT JOIN
	        " . XT::getDatabasePrefix() . "content_types as b ON (b.id = a.content_type)
	    WHERE
	        a.content_id=" . XT::getParam('cid') . "
	    AND
	        a.content_type=" . XT::getParam('ctype') . "
	    GROUP BY
	        a.title
	    ORDER BY
	        a.title ASC
	",__FILE__,__LINE__);
	while($row = $result->FetchRow()){
	    if($row['ext_link'] == NULL){
	        $row['url'] = str_replace('%id%',$row['content_id'],$row['open_url']);
	    }else{
	        $row['url'] = $row['ext_link'];
	    }
	    XT::assign("DATA",$row);
	}
	$content = XT::build($style);
} else {
	$content = XT::translate("Please set the parameter cid and ctype!");
}



?>