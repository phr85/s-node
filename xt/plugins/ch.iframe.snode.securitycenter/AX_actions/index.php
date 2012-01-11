<?php
switch(XT::getParam('action')){ 
	
	case "usernamexists":
	$result = XT::query("SELECT count(*) as count FROM " . $GLOBALS['plugin']->getTable("users") . " WHERE username='" . XT::getParam('username') . "'",__FILE__,__LINE__);
	$row = $result->FetchRow();
	$content = $row['count'];
	break;
	
	default:
	$content = "";
	break;
}
?>