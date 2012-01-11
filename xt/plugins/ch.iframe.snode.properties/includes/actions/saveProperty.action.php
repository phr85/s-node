<?php

// Load properties class
XT::loadClass('properties.class.php','ch.iframe.snode.properties');
$properties = new properties($GLOBALS['plugin']->getActiveLang());
$properties->renameProperty (XT::getValue("property_id"),XT::getValue("title"),$GLOBALS['plugin']->getActiveLang(), XT::getValue("description"));
$properties->setPropertyPosition(XT::getValue("property_id"),XT::getValue("position"));
$properties->setPropertyContentType(XT::getValue("property_id"),intval(XT::getValue("content_type")));
$properties->setPropertyType(XT::getValue("property_id"),XT::getValue("type"));

switch(XT::getValue("type")) {
	case 0:
		// hmmm.... nothing to do :-) Life can be so easy!
	break;

	case 1:
		if(XT::getValue('true') != "" && XT::getValue('false') != ""){
        	XT::setValue('value',XT::getValue('true') . '[|]' . XT::getValue('false'));
    	}
    break;

	case 2:
	    // number
	    if(is_numeric(XT::getValue('from')) && XT::getValue('from')!=""){
	        $prevalue = 'min:' . XT::getValue('from') . '[|]max:' . XT::getValue('to');
	    }else{
	        XT::setValue('value','');
	    }
	    if($prevalue != ""){
	        $values = explode('[|]',$prevalue);
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
	        XT::setValue('value','min:' . $fromvals[1] . '[|]max:' . $tovals[1]);
	    }
    break;

	case 3:
	    // dropdown
	    $labels = XT::getValue('label');
	    if(is_array(XT::getValue('dvalue'))){
	        foreach (XT::getValue('dvalue') as $key => $value) {
	            $values[$key] = $value . "[|]" . $labels[$key] . "[|]";
	            if(XT::getValue('default') == $key){
	                $values[$key] .= 'default';
	            }
	        }
	    }
	    if(XT::getValue('delete_field') != ""){
	        unset($values[XT::getValue('delete_field')]);
	    }
	    //$values = explode('[;]',XT::getValue('value'));
	    $default = false;
	    if(is_array($values)){
	        foreach ($values as $key => $value) {
	            $line = explode('[|]',$value);
	            if($line[0]==NULL){
	                $line[0] = $line[1];
	            }
	            if($line[1] != NULL){
	                if($line[2] != NULL && $default == false){
	                    $newarray[$key] = trim($line[0]) . '[|]' . trim($line[1]) . '[|]default';
	                    $default = true;
	                }else{
	                    $newarray[$key] = trim($line[0]) . '[|]' . trim($line[1]);
	                }
	            }
	        }
	    }
	    if(!$default){
	        if($newarray[0] == ""){
	            $newarray[0] .= ' [|] [|]default';
	        }else{
	            $newarray[0] .= '[|]default';
	        }
	    }
	    if(is_array($newarray)){
	        XT::setValue('value',implode('[;]\n',$newarray));
	    }else{
	        XT::setValue('value','');
	    }
    break;

	case 4:
	    // dropdown multi
	    $labels = XT::getValue('label');
	    $defaults = XT::getValue('default');
	    if(is_array(XT::getValue('dvalue'))){
	        foreach (XT::getValue('dvalue') as $key => $value) {
	            $values[$key] = $value . "[|]" . $labels[$key] . "[|]";
	            if($defaults[$key] == 'on'){
	                $values[$key] .= 'default';
	            }
	        }
	    }
	    if(XT::getValue('delete_field') != ""){
	        unset($values[XT::getValue('delete_field')]);
	    }

	    // $values = explode('[;]',XT::getValue('value'));
	    if(is_array($values)){
	        foreach ($values as $key => $value) {
	            $line = explode('[|]',$value);
	            if($line[0]==NULL){
	                $line[0] = $line[1];
	            }
	            if($line[1] != NULL){
	                if($line[2] != NULL){
	                    $newarray[$key] = trim($line[0]) . '[|]' . trim($line[1]) . '[|]default';
	                }else{
	                    $newarray[$key] = trim($line[0]) . '[|]' . trim($line[1]);
	                }
	            }
	        }
	    }
	    if(is_array($newarray)){
	        XT::setValue('value',implode('[;]\n',$newarray));
	    }else {
	        XT::setValue('value','');
	    }
    break;

	case 5:
	    // range of values (int)
	    if(is_numeric(XT::getValue('from_l')) && XT::getValue('from_l')!=""){
	        $prevalue = 'min:' . XT::getValue('from_l') . '[|]max:' . XT::getValue('to_l') . ';\nmin:' . XT::getValue('from_r') . '[|]max:' . XT::getValue('to_r');
	    }else{
	        XT::setValue('value','');
	    }
	    if($prevalue != ""){
	        $range = explode('[;]', $prevalue);
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
	        XT::setValue('value','min:' . $range_left['from'] . '[|]max:' . $range_left['to'] . ';\nmin:' . $range_right['from'] . '[|]max:' . $range_right['to']);
	    }
    break;

	case 6:
	break;

	 case 9:
	    // radio
	    $labels = XT::getValue('label');
	    if(is_array(XT::getValue('dvalue'))){
	        foreach (XT::getValue('dvalue') as $key => $value) {
	            $values[$key] = $value . "[|]" . $labels[$key] . "[|]";
	            if(XT::getValue('default') == $key){
	                $values[$key] .= 'default';
	            }
	        }
	    }
	    if(XT::getValue('delete_field') != ""){
	        unset($values[XT::getValue('delete_field')]);
	    }
	    //$values = explode('[;]',XT::getValue('value'));
	    $default = false;
	    if(is_array($values)){
	        foreach ($values as $key => $value) {
	            $line = explode('[|]',$value);
	            if($line[0]==NULL){
	                $line[0] = $line[1];
	            }
	            if($line[1] != NULL){
	                if($line[2] != NULL && $default == false){
	                    $newarray[$key] = trim($line[0]) . '[|]' . trim($line[1]) . '[|]default';
	                    $default = true;
	                }else{
	                    $newarray[$key] = trim($line[0]) . '[|]' . trim($line[1]);
	                }
	            }
	        }
	    }
	    if(!$default){
	        if($newarray[0] == ""){
	            $newarray[0] .= ' [|] [|]default';
	        }else{
	            $newarray[0] .= '[|]default';
	        }
	    }
	    if(is_array($newarray)){
	        XT::setValue('value',implode('[;]\n',$newarray));
	    }else{
	        XT::setValue('value','');
	    }
    break;

    case 10:
	    // checkbox
	    $labels = XT::getValue('label');
	    $defaults = XT::getValue('default');
	    if(is_array(XT::getValue('dvalue'))){
	        foreach (XT::getValue('dvalue') as $key => $value) {
	            $values[$key] = $value . "[|]" . $labels[$key] . "[|]";
	            if($defaults[$key] == 'on'){
	                $values[$key] .= 'default';
	            }
	        }
	    }
	    if(XT::getValue('delete_field') != ""){
	        unset($values[XT::getValue('delete_field')]);
	    }

	    // $values = explode('[;]',XT::getValue('value'));
	    if(is_array($values)){
	        foreach ($values as $key => $value) {
	            $line = explode('[|]',$value);
	            if($line[0]==NULL){
	                $line[0] = $line[1];
	            }
	            if($line[1] != NULL){
	                if($line[2] != NULL){
	                    $newarray[$key] = trim($line[0]) . '[|]' . trim($line[1]) . '[|]default';
	                }else{
	                    $newarray[$key] = trim($line[0]) . '[|]' . trim($line[1]);
	                }
	            }
	        }
	    }
	    if(is_array($newarray)){
	        XT::setValue('value',implode('[;]\n',$newarray));
	    }else {
	        XT::setValue('value','');
	    }
    break;
}

$properties->setPropertyValue(XT::getValue("property_id"),XT::getValue("value"));




// role permissions

XT::query("DELETE FROM " . XT::getTable('perms') . " WHERE property_id=" . $GLOBALS['plugin']->getValue('property_id'),__FILE__,__LINE__);
if(is_array(XT::getValue('roles'))){
    foreach (XT::getValue('roles') as $key => $value) {
        XT::query("INSERT INTO " . XT::getTable('perms') . " (role_id, property_id) VALUES (" . $key . ", " . XT::getValue('property_id') . ")",__FILE__,__LINE__);
    }
}

// Groups

XT::query("DELETE FROM " . XT::getTable('prop2group') . " WHERE property_id=" . XT::getValue('property_id'),__FILE__,__LINE__);
if(is_array(XT::getValue('groups'))){
    foreach (XT::getValue('groups') as $key => $value) {
        XT::query("INSERT INTO " . XT::getTable('prop2group') . " (group_id, property_id) VALUES (" . $key . ", " . XT::getValue('property_id') . ")",__FILE__,__LINE__);
    }
}

?>