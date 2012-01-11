<?php

// Parameter: Category ID to be shown
$cat = XT::getValue("cat_id");
// Value leer, Parameter benutzen
if ($cat == ''){
	$cat = XT::getParam("cat_id");
}

// If still empty, give error
if ($cat == ''){
	$cat = 0;
	echo "Please select a valid category";	
}

if ($cat == 1 OR $cat == 2){
	// Private Category, only accessible in admin 
	$cat = -1;
}

/**
 * Parameter :: Style (Template), Category Display TPL (Where is the single category display located?)
 */

$selected = array();

if ($cat == XT::getParam('cat_id')){
	$selected['showlink'] = false;
}elseif ($cat == -1){
	$selected['showlink'] = false;
}else{
	$selected['showlink'] = true;
}

// Get Category that was selected
$result = XT::query("
    SELECT
        *
	FROM 
		" . XT::getTable("faq_tree_details") . " as tree_details
	LEFT JOIN 
		" . XT::getTable('faq_tree') . " as tree ON (tree_details.node_id = tree.id)  
    WHERE
    	node_id = ".$cat."
",__FILE__,__LINE__,0);

	while($row = $result->FetchRow()){
			$selected['id'] = $row['pid'];
        	$selected['title'] = $row['title'];
    }

// Get categories associated with the selected category
$result = XT::query("
    SELECT
        *
	FROM 
		" . XT::getTable("faq_tree") . " as tree
	LEFT JOIN 
		" . XT::getTable('faq_tree_details') . " as tree_details ON (tree.id = tree_details.node_id)  
    WHERE
    	tree.pid = ".$cat."	AND
		tree_details.active = 1
    GROUP BY
        tree.id
",__FILE__,__LINE__,0);

$data = XT::getQueryData($result);

$viewertpl = XT::autoval("viewer_tpl","R");

XT::assign("xt" . XT::getBaseID() . "_selected", $selected);
XT::assign("xt" . XT::getBaseID() . "_category_list", $data);
XT::assign("xt" . XT::getBaseID() . "_viewer_tpl", $viewertpl);


// Get FAQ Items associated with selected Category
$articlequery = XT::query("
	SELECT
		*
	FROM
		" . XT::getTable('faq2cat') . " as rel
	LEFT JOIN 
		" . XT::getTable('faq') . " as articles ON (articles.id = rel.faq_id)
	WHERE 
		rel.node_id = " . $cat . " AND
		articles.active = 1
	ORDER BY
		date desc
	"
,__FILE__,__LINE__);
    	
$temp = XT::getQueryData($articlequery);

XT::assign("xt" . XT::getBaseID() . "_items",$temp);

$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';
$content = XT::build($style);

?>