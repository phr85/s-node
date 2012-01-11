<?php
$tpl->register_function("xt_get_relations","xt_get_relations");
function xt_get_relations($params){

	$cid = $params['cid'];
	$ctype = $params['ctype'];;
	$lang = $params['lang'];;
	
	if(empty($lang)){
		$lang = XT::getLang();
	}

	 $result = XT::query("
	SELECT
	    rel.*,
		ct.icon
	FROM
	    " . XT::getDatabasePrefix()  . "relations as rel LEFT JOIN
		" . XT::getDatabasePrefix()   . "content_types as ct ON (ct.id = rel.content_type)
	WHERE
	    rel.target_content_type = " . $ctype . " AND
		rel.target_content_id = " . $cid . " AND
	    rel.lang = '" . $lang . "'
	ORDER BY
	    position ASC
	",__FILE__,__LINE__);
	 
	$data = array();
	$data['list'] = XT::getQueryData($result);
	foreach ($data['list'] as $key => $rels) {
		$data['grouped'][$rels['content_type']][] = $key;
	}
	XT::assign("RELATIONS",$data);
}
?>