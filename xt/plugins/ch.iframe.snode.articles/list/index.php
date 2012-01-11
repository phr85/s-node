<?php

// Parameter :: Style
$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';

// Parameter :: XML
$xml = XT::getParam('xml') != '' ? XT::getParam('xml') : false;
if($xml){
	header('content-type: application/rss+xml; charset=utf-8');
}

// Parameter :: recursive
$recursive = XT::getParam('recursive') != '' ? XT::getParam('recursive') : 'no';

// Parameter :: Linking
$link2details = XT::getParam('link2details') != '' ? XT::getParam('link2details') : 'no';

// Parameter :: Category
$category = XT::autoval('categories',"P",1);


// Search recursive
if ($recursive == "yes") {
	$sql = "SELECT * FROM " .  XT::getTable('articles_tree')  . " WHERE id IN (" . $category . ")";
	$result = XT::query($sql, __FILE__, __LINE__);
	while ($row = $result->fetchRow()) {
		$sql = 'SELECT DISTINCT id FROM ' . XT::getTable('articles_tree')  . ' WHERE l >= ' . $row['l'] . ' AND r <= ' . $row['r'];
		$sub_result = XT::query($sql, __FILE__, __LINE__);
		while ($sub_row = $sub_result->fetchRow()) {
			$subcategories[] = $sub_row['id'];
		}
	}
	if (is_array($subcategories)) {
	 	$category .= "," . implode(",",$subcategories);
	}
}


// Parameter :: Target
$target_tpl = XT::getParam('target_tpl') != '' ? XT::getParam('target_tpl') : '113';


// If Archive Module has set an article range
$visibleRangeFrom = XT::autoval(XT::getParam("connector") . "visibleRangeFrom","R",0,true);
$visibleRangeTo = XT::autoval(XT::getParam("connector") . "visibleRangeTo","R",0,true);

if ($visibleRangeFrom > 0 && $visibleRangeTo > 0){
	$limit = "";
	$timerange = " AND art.date between " . $visibleRangeFrom . " AND " . $visibleRangeTo . " ";
}else{
	// Parameter :: Count
	$limit = XT::getParam('count') != '' ? "LIMIT " . XT::getParam('count') : 'LIMIT 5';
}

// order
if(XT::getParam('order')!=""){
	$order_by = "n." . XT::getParam('order');
}else {
	$order_by = "n.display_time_end ASC, n.display_time_start DESC, n.creation_date DESC";
}

if($category != '0') {

	$result = XT::query("
        SELECT
            rel.article_id,
            tree.title,
            tree.image as nodeimage,
            tree.node_id as nodeid
        FROM
            " . XT::getTable('articles_tree_rel') . " as rel
        INNER JOIN
            " . XT::getTable('articles') . " as n on (rel.article_id = n.id)
        INNER JOIN " . XT::getTable('articles_tree_details') . " as tree ON rel.node_id =tree.node_id AND tree.lang='" . XT::getLang() . "'

        WHERE
            rel.node_id IN (" . $category . ")
        AND
            (n.display_time_start = 0 OR n.display_time_start < " . time() . ")
        AND
            (n.display_time_end = 0 OR n.display_time_end > " . time() . ")
        AND
            n.lang='" . XT::getLang() . "'
        AND n.active=1" .
		$timerange . "
		ORDER BY " . $order_by
		 . " " .  $limit

           , __FILE__, __LINE__);

	while ($row = $result->fetchRow()) {
		$article_ids[] = $row['article_id'];
		$nodedetails[$row['article_id']] = $row;
	}
}

if (is_array($article_ids)) {
	$data = array();
		$sql = "
	    SELECT
	        n.id,
	        n.creation_user as c_id,
	        n.title,
	        n.subtitle,
	        n.introduction,
	        n.creation_date,
			n.mod_date,
	        n.date,
	        n.active,
	        n.autor,
	        n.image,
	        n.image_version,
	        n.image_link,
	        m.description as img_description
	    FROM
	        " . XT::getTable('articles') . " as n LEFT JOIN
	        " . XT::getTable('files_details') . " as m ON (m.id = n.image AND m.lang = '" . XT::getLang() . "')
	    WHERE
	        n.active = 1 AND
	        n.lang = '" . XT::getLang() . "'
			AND n.id in (" . implode(",",$article_ids) . ")

		    ORDER BY " . $order_by
		 . " " .  $limit
		 ;
		// SQL
		$result = XT::query($sql,__FILE__,__LINE__);
		$data = XT::getQueryData($result);
}

XT::assign("TREESELECTED",XT::getSessionValue("TREESELECTED"));
XT::assign("TREEWAY", XT::getSessionValue("TREEWAY"));
XT::assign("NODEDETAILS", $nodedetails);
XT::assign("LINK2DETAILS", $link2details);
XT::assign("TARGET_TPL", $target_tpl);
XT::assign("DATA", $data);
XT::assign("ADMIN_TPL", $GLOBALS['plugin']->getConfig('admin_tpl'));
XT::assign("CATEGORY",$category);
$content = XT::build($style);

?>
