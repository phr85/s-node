<?php
XT::assign("RESULT", "");
XT::assign("USER_INPUT", "");
if (XT::getValue("whois")){
	set_time_limit(20);
	
	$name = XT::getValue("whois");
	$tmp = explode(".",$name);
	if (count($tmp) == 4) {
		foreach ($tmp as $element){
			if (is_numeric($element)){
				$ip = true;
			} else {
				$ip = false;
			}
		}
	} 
	if($ip == false){
		$tld = array_pop($tmp);
		$domainname = array_pop($tmp);
		$request = $domainname . "." . $tld;
	} else {
		$request = $name;
	}
	//build the command
	$cmd = XT::getConfig('cmd_whois') . " -H " . $request;
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
		
		default:
			$result = $returncode;
		break;
	}
	//Assign the results and default values
	XT::assign("RESULT", $result);
	$result = "";
	XT::assign("USER_INPUT", XT::getValue("whois"));
}

// Build plugin
$style = $GLOBALS['plugin']->getParam('style') != '' ? $GLOBALS['plugin']->getParam('style') : 'default.tpl';
$content = XT::build($style);
?>
