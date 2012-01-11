<?php
XT::assign("RESULT", "");
XT::assign("USER_INPUT", "");
if (XT::getValue("traceroute")){
	set_time_limit(20);

	//build the command
	$cmd = XT::getConfig('cmd_traceroute') . " " . XT::getValue("traceroute");
	$cmd = escapeshellcmd($cmd);

	//execute the command
	exec($cmd,$status,$returncode);
	
	//Display the result in subject to the return code of the application
	switch($returncode){
		case 0:
			foreach ($status as $s) {
				$result .= $s . "\n";
			}
		break;
		
		case 1:
			$result = XT::translate("unknown host") . " " . XT::getValue("traceroute");
		break;
		
		default:
			$result = $returncode;
		break;
	}
	//Assign the results and default values
	XT::assign("RESULT", $result);
	$result = "";
	XT::assign("USER_INPUT", XT::getValue("traceroute"));
}

// Build plugin
$style = $GLOBALS['plugin']->getParam('style') != '' ? $GLOBALS['plugin']->getParam('style') : 'default.tpl';
$content = XT::build($style);
?>
