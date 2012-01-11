<?php
XT::assign("RESULT", "");
XT::assign("USER_INPUT", "");
if (XT::getValue("nslookup")){
	set_time_limit(20);

	if(XT::getValue("nslookup_type") == "default"){
		//build the command
		$cmd = XT::getConfig('cmd_nslookup') . " " . XT::getValue("nslookup");
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
	}
	
	if(XT::getValue("nslookup_type") == "any"){
		//build the command
		$cmd = XT::getConfig('cmd_nslookup') . " -type=any " . XT::getValue("nslookup");
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
	}
	
	if(XT::getValue("nslookup_type") == "reverse"){
		//build the command
		$cmd = XT::getConfig('cmd_dig') . " -x " . XT::getValue("nslookup");
		echo $cmd = escapeshellcmd($cmd);
		
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
	}
	
	if(XT::getValue("nslookup_type") == "trace"){
		//build the command
		$cmd = XT::getConfig('cmd_dig') . " -x " . XT::getValue("nslookup") . " +trace";
		echo $cmd = escapeshellcmd($cmd);
		
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
	}
	
	//Assign the results and default values
	XT::assign("RESULT", $result);
	$result = "";
	XT::assign("USER_INPUT", XT::getValue("nslookup"));
	XT::assign("TYPE", XT::getValue("nslookup_type"));
}

// Build plugin
$style = $GLOBALS['plugin']->getParam('style') != '' ? $GLOBALS['plugin']->getParam('style') : 'default.tpl';
$content = XT::build($style);
?>
