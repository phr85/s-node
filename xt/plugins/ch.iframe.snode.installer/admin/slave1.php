<?php

if (eregi('fsockopen', ini_get('disable_functions'))) {
	XT::assign('fsockopen','disabled');	
} else {
	XT::assign('fsockopen','enabled');	
}
XT::assign('DEVELOPER_MODE',XT::getConfig("developer_mode"));	
$content = XT::build("slave1.tpl");
?>
