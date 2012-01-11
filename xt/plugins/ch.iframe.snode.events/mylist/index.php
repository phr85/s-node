<?php
// Parameter :: Style
$style = $GLOBALS['plugin']->getParam('style') != '' ? $GLOBALS['plugin']->getParam('style') : 'default.tpl';

if (XT::isLoggedIn() && XT::getPermission('selfmanage')) {
	$result = XT::query("
SELECT tree_detail.title,
    tree_detail.title as cat,
    events.*,
    details.*
FROM " . XT::getTable("events_tree_rel") . " as rel INNER JOIN " . XT::getTable("events_tree_details") . " as tree_detail ON rel.node_id = tree_detail.node_id
     INNER JOIN " . XT::getTable("events") . " as events ON rel.event_id = events.id
     INNER JOIN " . XT::getTable("events_details") . " as details ON events.id = details.id
WHERE details.lang='" . XT::getLang() . "'
AND
tree_detail.lang='" . XT::getLang() . "'
AND
events.user_id=" . XT::getUserid() . "
 ORDER by events.display_time_start DESC , events.from_date DESC
",__FILE__,__LINE__,0);

	while($row = $result->fetchRow()) {
	    $data[] = $row;
	}
	XT::assign("EVENTS", $data);

	XT::assign("EDIT_TPL",XT::getParam('edit_tpl') );
} else {
	$style = "login.tpl";
}

$content = XT::build($style);
?>