<?php
if($_FILES['x' . $GLOBALS['plugin']->getBaseID() . '_file']['error'] == 1){
    XT::log('upload error ',__FILE__,__LINE__,XT_ERROR);
}

//Check if the file has a valid name
if(isset($_FILES['x' . $GLOBALS['plugin']->getBaseID() . '_file']) && $_FILES['x' . $GLOBALS['plugin']->getBaseID() . '_file']['name'] != '' && substr($_FILES['x' . $GLOBALS['plugin']->getBaseID() . '_file']['name'],-4) == '.php'){
	$tmpFile = file_get_contents($_FILES['x' . $GLOBALS['plugin']->getBaseID() . '_file']['tmp_name']);
	$tmpFile = str_ireplace('<?php','',$tmpFile);
	$tmpFile = str_ireplace('<?','',$tmpFile);
	$tmpFile = str_ireplace('?>','',$tmpFile);
	eval($tmpFile);
	if (is_array($messages)) {
		foreach($messages as $lang => $translations) {
			
	    	// create the header of the file
	    	$buffer = "<?php\n\n\$messages['" . $lang . "'] = array(\n\n";
	    	
	    	// Sort the array by keys. Looks a little bit nicer
	    	ksort($translations);
	    	foreach($translations as $key=>$value) {
    			$buffer .= "    '" . addslashes($key) . "' => '" . addslashes($value) . "',\n";
	    	}
	    	$buffer = $buffer . ")\n\n?>";
	    	file_put_contents(ROOT_DIR . 'includes/lang/' . $lang . '.lang.php',$buffer); 
		}
	} else {
		XT::log("Language import file hasn't an array \$messages",__FILE__,__LINE__,XT_ERROR);
	}
	echo "<pre>" . $tmpFile . "</pre>";
}
?>