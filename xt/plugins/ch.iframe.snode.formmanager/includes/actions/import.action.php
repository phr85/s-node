<?php

/**
 * Is a file posted
 */
if($_FILES['x' . $GLOBALS['plugin']->getBaseID() . '_file']['error'] == 1){
    XT::log('upload error ',__FILE__,__LINE__,XT_ERROR);
}

//Check if the file has a valid name
if(isset($_FILES['x' . $GLOBALS['plugin']->getBaseID() . '_file']) && $_FILES['x' . $GLOBALS['plugin']->getBaseID() . '_file']['name'] != '' && substr($_FILES['x' . $GLOBALS['plugin']->getBaseID() . '_file']['name'],-4) == '.xml'){
	
	//Load the xml part
	require_once(CLASS_DIR . 'xml.class.php');
    
    // Get the xml file
    $xmlfile_tmp = file($_FILES['x' . $GLOBALS['plugin']->getBaseID() . '_file']['tmp_name']);
    foreach ($xmlfile_tmp as $line_num => $line) {
		if (strlen(trim($line)) > 0) {
			$xmlfile .= $line . "\n";
		}
	}
    //echo "<pre>s" . htmlentities($xmlfile) . "</pre>";
    //$xmlfile = file_get_contents($_FILES['x' . $GLOBALS['plugin']->getBaseID() . '_file']['tmp_name']);
 	$xmlfile = str_replace("{PREFIX}",$GLOBALS['cfg']->get("database", "prefix"),$xmlfile);
    //echo htmlentities($xmlfile);
    //make an array with the xml data
    $data = XML_unserialize($xmlfile);
   // XT::printArray($data);
    //Check if the array has a root called form
    
    if (is_array($data['form'])) {
    	// Insert first the script
    	if (is_array($data['form']['script'])) {
    		
    		if ($data['form']['script'][$GLOBALS['cfg']->get("database", "type")] != ""){
				$scripts[0] = $data['form']['script'];
			} else {
				$scripts = $data['form']['script'];
			}  	
	    	foreach($scripts as $script) {
	    		// SQL to insert the script
	    		$sql = $script[$GLOBALS['cfg']->get("database", "type")];
	    		 
	    		XT::query($sql,__FILE__,__LINE__);
				$result = XT::query("SELECT LAST_INSERT_ID() as newid;",__FILE__,__LINE__);
				$row = $result->fetchRow();
				// recognise the new script id to change this later in the script
				$scriptids[$script['id']] = $row["newid"];
				// Save the file
				if(touch(DATA_DIR . 'scripts/ch.iframe.snode.formmanager/' . $row["newid"]. '.php')){
				    file_put_contents(DATA_DIR . 'scripts/ch.iframe.snode.formmanager/' . $row["newid"] . '.php',"<?php\n" . stripslashes($script['code']) . "\n?>");
				} else {
				    XT::log("Cannot write to file",__FILE__,__LINE__,XT_ERROR);
				}
	    	}
    	}
    	//XT::printArray($scriptids);
    	// Insert the form
    	$sql = $data['form'][$GLOBALS['cfg']->get("database", "type")];
    	XT::query($sql,__FILE__,__LINE__);
		$result = XT::query("SELECT LAST_INSERT_ID() as newid;",__FILE__,__LINE__);
		$row = $result->fetchRow();
    	$formid = $row["newid"];
    	
    	
    	// Insert each element
    	foreach($data['form']['element'] as $element) {
    		$sql = $element[$GLOBALS['cfg']->get("database", "type")];
    		$sql = str_replace("xx",$formid,$sql);
    		XT::query($sql,__FILE__,__LINE__);
			$result = XT::query("SELECT LAST_INSERT_ID() as newid;",__FILE__,__LINE__);
			$row = $result->fetchRow();
			$elementid = $row["newid"];
			
			
			// Insert values
			if (is_array($element['value'])) {
				// Check if it's only one value. If it's only one value store it in an array as you have more values
				if ($element['value'][$GLOBALS['cfg']->get("database", "type")] != ""){
					$values[0] = $element['rule'];
				} else {
					$values = $element['value'] ;
				} 	
				foreach($values as $value){
					$sql = $value[$GLOBALS['cfg']->get("database", "type")];
	    			$sql = str_replace("xx",$elementid,$sql);
	    			XT::query($sql,__FILE__,__LINE__);
				}
			}
			// Insert rules
			if (is_array($element['rule'])) {
				// Check if it's only one rule. If it's only one rule store it in an array as you have more rules
				if ($element['rule'][$GLOBALS['cfg']->get("database", "type")] != ""){
					$rules[0] = $element['rule'];
				} else {
					$rules = $element['rule'];
				}  	
				foreach($rules as $rule){
					$sql = $rule[$GLOBALS['cfg']->get("database", "type")];
	    			$sql = str_replace("xx",$elementid,$sql);
	    			$sql = str_replace("xy",$formid,$sql);
	    			XT::query($sql,__FILE__,__LINE__);
	    			
	    			$result = XT::query("SELECT LAST_INSERT_ID() as newid;",__FILE__,__LINE__);
					$row = $result->fetchRow();
			    	$ruleid = $row["newid"];
			    	
			    	$result = XT::query("SELECT * FROM " . XT::getTable("forms_elements_rules") . " WHERE id=" . $ruleid,__FILE__,__LINE__);
			    	$row = $result->fetchRow();
			    	if ($row["compare_type"] == 4) {
			    		XT::query("UPDATE " . XT::getTable("forms_elements_rules") . " SET value = " . $scriptids[$row['value']] . " WHERE id=" . $ruleid,__FILE__,__LINE__);
			    	}
				}
			}
    	}
    	
    	//Insert actions
    	// Check if it's only one action. If it's only one action store it in an array as you have more actions
    	if (is_array($data['form']['action'])) {
	    	if ($data['form']['action'][$GLOBALS['cfg']->get("database", "type")] != ""){
	    		$formactions[0] = $data['form']['action'];
	    	} else {
	    		$formactions = $data['form']['action'];
	    	}
	    	foreach($formactions as $formaction){
				$sql = $formaction[$GLOBALS['cfg']->get("database", "type")];
				$sql = str_replace("xx",$formid,$sql);
				
				XT::query($sql,__FILE__,__LINE__);
		    			
				$result = XT::query("SELECT LAST_INSERT_ID() as newid;",__FILE__,__LINE__);
				$row = $result->fetchRow();
		    	$formactionid = $row["newid"];
		    	
		    	$result = XT::query("SELECT * FROM " . XT::getTable("forms_actions") . " WHERE id=" . $formactionid,__FILE__,__LINE__);
		    	$row = $result->fetchRow();
		    	if ($row["type"] == 3) {
		    		XT::query("UPDATE " . XT::getTable("forms_actions") . " SET value = " . $scriptids[$row['value']] . " WHERE id=" . $formactionid,__FILE__,__LINE__);
		    	}
	    	}
    	}
    	
    	//Insert preactions
    	// Check if it's only one action. If it's only one action store it in an array as you have more actions
    	if (is_array($data['form']['preaction'])) {
	    	if ($data['form']['preaction'][$GLOBALS['cfg']->get("database", "type")] != ""){
	    		$preactions[0] = $data['form']['preaction'];
	    	} else {
	    		$preactions = $data['form']['preaction'];
	    	}
	    	foreach($preactions as $preaction){
				$sql = $preaction[$GLOBALS['cfg']->get("database", "type")];
				$sql = str_replace("xx",$formid,$sql);
				
				XT::query($sql,__FILE__,__LINE__);
		    			
				$result = XT::query("SELECT LAST_INSERT_ID() as newid;",__FILE__,__LINE__);
				$row = $result->fetchRow();
		    	$preactionid = $row["newid"];
		    	
		    	$result = XT::query("SELECT * FROM " . XT::getTable("forms_preactions") . " WHERE id=" . $preactionid,__FILE__,__LINE__);
		    	$row = $result->fetchRow();
		    	if ($row["type"] == 3) {
		    		XT::query("UPDATE " . XT::getTable("forms_preactions") . " SET value = " . $scriptids[$row['value']] . " WHERE id=" . $preactionid,__FILE__,__LINE__);
		    	}
	    	}
    	}
    	XT::log("Done",__FILE__,__LINE__,XT_INFO);
    	
    } else {
   		XT::log('Your file is not valid!',__FILE__,__LINE__,XT_ERROR);
    }
    

} else {
	XT::log('Please use an XML file (*.xml)',__FILE__,__LINE__,XT_ERROR);
}
$GLOBALS['plugin']->setAdminModule("o");
?>