<?php
// Parameter :: Style
$style = $GLOBALS['plugin']->getParam('style') != '' ? $GLOBALS['plugin']->getParam('style') : 'default.tpl';

$mode = $GLOBALS['plugin']->getParam('mode') != '' ? $GLOBALS['plugin']->getParam('mode') : 'user';

// Ensure that the data array is empty
$data = "";

if (XT::isLoggedIn() && XT::getPermission('selfmanage')) {
	$id = XT::getUserid();
	
	//Display only active addresses by default unless the mode is set to admin
	$active = " AND active=1";
	if ($mode == "admin") {
		$active = "";
	}
	
	$result = XT::query("
	SELECT
	   *
	FROM
	    " . XT::getTable('addresses') . "
	WHERE
		user_id = " . $id . "
		" . $active . "
	ORDER BY title ASC
	",__FILE__,__LINE__);
	// Assign the query data
	$data['data'] = XT::getQueryData($result);
	
	$data['edit_tpl'] = XT::getParam('edit_tpl');
	$data['mode'] = $mode;

	XT::assign("xt" . XT::getBaseID() . "_user_list", $data);
} else {
	$style = "login.tpl";
}
 
 $content = XT::build($style);
?>
