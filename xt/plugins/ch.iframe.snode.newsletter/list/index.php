<?php
/**
 * List all newsletter from the past
 *
 * @author Markus Graf
 * @version $Id:$
 */
// Ensure that the data array is empty
$data = array();

 // Get the style from the parameter or take the default parameter default.tpl
$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';

// Set the order
$order = XT::getParam('order') != '' ? XT::getParam('order') : 'ORDER BY nl.sent_date DESC';

// Number of records
$limit = XT::getParam('limit') != '' ? "Limit 0," . XT::getParam('limit') : '';

// Number of records
$categories = XT::getParam('categories') != '' ? XT::getParam('categories') : '';

// Parameter :: Target
$target_tpl = $GLOBALS['plugin']->getParam('target_tpl') != '' ? $GLOBALS['plugin']->getParam('target_tpl') : '113';

// Get all data
if ($categories != 0 && $categories != "") {
	$sql = "
	    SELECT
	       DISTINCT nl.*
	    FROM
	        " . XT::getTable('newsletter') . " as nl,
			" . XT::getTable('newsletter_newsl2cat') . " as n2c
		WHERE
		   nl.lang = '" . $GLOBALS['lang']->getLang() . "'
		  AND nl.id = n2c.newsletter_id
		  AND n2c.category_id IN (" . $categories . ")
	    " . $order . "
		" . $limit . "
	";
} else {
	    $sql = "
	    SELECT
	       DISTINCT nl.*
	    FROM
	        " . XT::getTable('newsletter') . " as nl
		WHERE
		   nl.lang = '" . $GLOBALS['lang']->getLang() . "'
	    " . $order . "
		" . $limit . "
	";
}
$result = XT::query($sql,__FILE__,__LINE__);
while($row = $result->FetchRow()){
	
	// Get all categories for this newsletter to see in which categories it is
	$sql = "
	    SELECT
	       cat.*
	    FROM
	       " . XT::getTable('newsletter_categories') . " as cat,
			" . XT::getTable('newsletter_newsl2cat') . " as n2c
		WHERE
		   n2c.newsletter_id = " . $row['id'] . "
		AND n2c.category_id = cat.id
	";
	$subresult = XT::query($sql,__FILE__,__LINE__);
	while ($subrow = $subresult->FetchRow()) {
		$row['categories'][] = $subrow;
	}
	
	// Assign all data
	$data['data'][] = $row;
}
$data['target_tpl'] = $target_tpl;

// Assign the data to the template
XT::assign("xt" . XT::getBaseID() . "_list", $data);

// Build and throw out the content
$content = XT::build($style);
?>
