<?php
if(XT::getPermission("manageProperties")){

	XT::addImageButton('Save','saveProperty','default','save.png','0','slave1');

	// Load properties class
	XT::loadClass('properties.class.php','ch.iframe.snode.properties');
	$properties = new properties($GLOBALS['plugin']->getActiveLang());
	$propertyData =  $properties->getPropertyAttributes(XT::getValue('property_id'));
	XT::assign('DATA',$propertyData);

	switch ($propertyData['type']) {
		case 0:
		 // Nothing to do :-)
		break;

		case 1:
			if ($propertyData['value'] != "") {
				$tmp = explode("[|]",$propertyData['value']);
			} else {
				$tmp[0] = 1;
				$tmp[1] = 0;
			}
			XT::assign("VALUE",$tmp);
		break;

		case 2:
	        if($propertyData['value']!= ""){
	            $values = explode('[|]',$propertyData['value']);
	            $fromvals = explode(':',$values[0]);
	            if($fromvals[1] == NULL){
	                $fromvals[1] = intval($fromvals[0]);
	                $fromvals[0] = 'min';
	            }else{
	                $fromvals[1] = intval($fromvals[1]);
	            }

	            $tovals = explode(':',$values[1]);
	            if($tovals[1] == NULL){
	                $tovals[1] = intval($tovals[0]);
	                $tovals[0] = 'max';
	            }else{
	                $tovals[1] = intval($tovals[1]);
	            }
	            if($fromvals[1] >= $tovals[1]){
	                $tovals[1] = $fromvals[1] + 1;
	            }
	            $numbers['from'] = $fromvals[1];
	            $numbers['to'] = $tovals[1];
	            XT::assign('NUMBER',$numbers);

	        }
        break;
        case 3:
	        $values = explode('[;]',$propertyData['value']);
	        $default = false;
	        foreach ($values as $key => $value) {
	            $line = explode('[|]',$value);
	            if($line[1]==NULL){
	                $line[1] = $line[0];
	            }
	            if($line[0] != NULL){
	                if($line[2] != NULL && $default == false){
	                    $newarray[$key]['value'] = trim($line[0]);
	                    $newarray[$key]['label'] = trim($line[1]);
	                    $newarray[$key]['default'] = 1;
	                    $default = true;
	                }else{
	                    $newarray[$key]['value'] = trim($line[0]);
	                    $newarray[$key]['label'] = trim($line[1]);
	                    $newarray[$key]['default'] = 0;

	                }
	            }
	        }
	        if(!$default){
	            $newarray[0]['default'] = 1;
	        }
	        XT::assign('DROPDOWN', $newarray);
        break;

	    case 4:
	        $values = explode('[;]',$propertyData['value']);
	        foreach ($values as $key => $value) {
	            $line = explode('[|]',$value);
	            if($line[1]==NULL){
	                $line[1] = $line[0];
	            }
	            if($line[0] != NULL){
	                if($line[2] == 'default'){
	                    $newarray[$key]['value'] = trim($line[0]);
	                    $newarray[$key]['label'] = trim($line[1]);
	                    $newarray[$key]['default'] = 1;
	                }else{

	                    $newarray[$key]['value'] = trim($line[0]);
	                    $newarray[$key]['label'] = trim($line[1]);
	                    $newarray[$key]['default'] = 0;
	                }
	            }
	        }

	        XT::assign('DROPDOWN', $newarray);

        break;

        case 5:
	        if($propertyData['value']!= ""){
	            $range = explode('[;]', $propertyData['value']);
	            // left range
	            $values = explode('[|]', $range[0]);
	            $fromvals = explode(':',$values[0]);
	            if($fromvals[1] == NULL){
	                $fromvals[1] = intval($fromvals[0]);
	                $fromvals[0] = 'min';
	            }else{
	                $fromvals[1] = intval($fromvals[1]);
	            }

	            $tovals = explode(':',$values[1]);
	            if($tovals[1] == NULL){
	                $tovals[1] = intval($tovals[0]);
	                $tovals[0] = 'max';
	            }else{
	                $tovals[1] = intval($tovals[1]);
	            }
	            if($fromvals[1] >= $tovals[1]){
	                $tovals[1] = $fromvals[1] + 1;
	            }
	            $range_left['from'] = $fromvals[1];
	            $range_left['to'] = $tovals[1];


	            // right range
	            $values = explode('[|]', $range[1]);
	            $fromvals = explode(':',$values[0]);
	            if($fromvals[1] == NULL){
	                $fromvals[1] = intval($fromvals[0]);
	                $fromvals[0] = 'min';
	            }else{
	                $fromvals[1] = intval($fromvals[1]);
	            }

	            $tovals = explode(':',$values[1]);
	            if($tovals[1] == NULL){
	                $tovals[1] = intval($tovals[0]);
	                $tovals[0] = 'max';
	            }else{
	                $tovals[1] = intval($tovals[1]);
	            }
	            if($fromvals[1] >= $tovals[1]){
	                $tovals[1] = $fromvals[1] + 1;
	            }
	            $range_right['from'] = $fromvals[1];
	            $range_right['to'] = $tovals[1];

	            if($range_left['to'] > $range_right['from']){
	                $range_right['from'] = $range_left['to'] + 1;
	                $range_right['to'] = $range_right['from'] + 1;
	            }

	            $numbers['from_l'] = $range_left['from'];
	            $numbers['to_l'] = $range_left['to'];
	            $numbers['from_r'] = $range_right['from'];
	            $numbers['to_r'] = $range_right['to'];
	            XT::assign('NUMBER',$numbers);
	        }
        break;

        case 6:
            XT::assign('TARGET_CONTENT_TYPE', $propertyData['value']);
            $result = XT::query("
                SELECT 
                    ct.id, 
                    ct.title , 
                    cp.template
                FROM 
                    " . XT::getDatabasePrefix() . "content_types as ct,
                    " . XT::getDatabasePrefix() . "pickers cp
                WHERE 
                    cp.content_type = ct.id  
            ",__FILE__,__LINE__);
            
            $content_types[$relation['target_content_type']]['id'] =  $relation['target_content_type'];
            $content_types[$relation['target_content_type']]['title'] =  'no picker defined (' . $relation['target_content_type'] .')';

            while ($row = $result->fetchRow()) {
                $content_types[$row['id']] = $row;
            }
            
            XT::assign("CTYPES", $content_types);
        break;
        
        case 7:
            XT::assign('TARGET_CONTENT_TYPE', $propertyData['value']);
            $result = XT::query("
                SELECT 
                    ct.id, 
                    ct.title , 
                    cp.template
                FROM 
                    " . XT::getDatabasePrefix() . "content_types as ct,
                    " . XT::getDatabasePrefix() . "pickers cp
                WHERE 
                    cp.content_type = ct.id  
            ",__FILE__,__LINE__);
            
            $content_types[$relation['target_content_type']]['id'] =  $relation['target_content_type'];
            $content_types[$relation['target_content_type']]['title'] =  'no picker defined (' . $relation['target_content_type'] .')';

            while ($row = $result->fetchRow()) {
                $content_types[$row['id']] = $row;
            }
            
            XT::assign("CTYPES", $content_types);
        break;

         case 9:
	        $values = explode('[;]',$propertyData['value']);
	        $default = false;
	        foreach ($values as $key => $value) {
	            $line = explode('[|]',$value);
	            if($line[1]==NULL){
	                $line[1] = $line[0];
	            }
	            if($line[0] != NULL){
	                if($line[2] != NULL && $default == false){
	                    $newarray[$key]['value'] = trim($line[0]);
	                    $newarray[$key]['label'] = trim($line[1]);
	                    $newarray[$key]['default'] = 1;
	                    $default = true;
	                }else{
	                    $newarray[$key]['value'] = trim($line[0]);
	                    $newarray[$key]['label'] = trim($line[1]);
	                    $newarray[$key]['default'] = 0;

	                }
	            }
	        }
	        if(!$default){
	            $newarray[0]['default'] = 1;
	        }
	        XT::assign('DROPDOWN', $newarray);
        break;

        case 10:
	        $values = explode('[;]',$propertyData['value']);
	        foreach ($values as $key => $value) {
	            $line = explode('[|]',$value);
	            if($line[1]==NULL){
	                $line[1] = $line[0];
	            }
	            if($line[0] != NULL){
	                if($line[2] == 'default'){
	                    $newarray[$key]['value'] = trim($line[0]);
	                    $newarray[$key]['label'] = trim($line[1]);
	                    $newarray[$key]['default'] = 1;
	                }else{

	                    $newarray[$key]['value'] = trim($line[0]);
	                    $newarray[$key]['label'] = trim($line[1]);
	                    $newarray[$key]['default'] = 0;
	                }
	            }
	        }

	        XT::assign('DROPDOWN', $newarray);

        break;
	}

	// get all content types
	 $result = XT::query("
	    SELECT
	        *
	    FROM
	      " . XT::getTable("content_types"). "
	    ORDER BY
	        title ASC
	",__FILE__,__LINE__);

    XT::assign("CONTENT_TYPES", XT::getQueryData($result));



    $result = XT::query("
     SELECT r.id, r.title, (pr.role_id is not null) as allowed FROM " . XT::getDatabasePrefix() . "roles as r LEFT JOIN
    " . XT::getTable('perms') . "  as pr ON(pr.property_id = " . XT::getValue('property_id') . " AND pr.role_id = r.id)
    ORDER by r.title asc"
    ,__FILE__,__LINE__,0);

    XT::assign('ROLES',XT::getQueryData($result));



    /**
     * Get group data
     */
    $result = XT::query("SELECT fg.group_id as id, fg.lang, fg.title, fg.description,(frel.property_id>0) as selected
        FROM " . XT::getTable("pgroups_details") . " as fg
        LEFT JOIN " . XT::getTable("prop2group") . " as frel ON (frel.group_id = fg.group_id AND frel.property_id=" . XT::getValue('property_id') . ")
        WHERE fg.lang='" . $GLOBALS['plugin']->getActiveLang() . "'
        ORDER by fg.title ASC
    ",__FILE__,__LINE__);
    XT::assign("GROUPS",XT::getQueryData($result));


	// Fetch content
	$content = XT::build("properties_edit.tpl");
}else{
    XT::log("No Permission \"edit\" (BaseID:" . XT::getBaseID() . ")" ,__FILE__,__LINE__,XT_ERROR);
}

?>