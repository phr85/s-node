<?php
/**
 * addUnit
 *
 * @package S-Node
 * @subpackage Units
 * @author Veith Zaech <vzaech@iframe.ch>
 * @copyright Copyright 2005, iframe AG, http://www.iframe.ch
 * @version $Id: properties_edit.php 2252 2005-11-21 18:32:19Z vzaech $
 */

// set And get session values
if(!XT::getValue('property_id')){
    XT::setValue('property_id', XT::getSessionValue('property_id'));
}else{
    XT::setSessionValue('property_id',XT::getValue('property_id'));
}
if(XT::getPermission("manageProperties")){
    // Enable page navigator
    XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
    XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

    
    $result = XT::query("
        SELECT
            p.id,
            p.lang,
            p.title,
            p.description,
            p.position,
            p.type,
            p.value
        FROM
            " . XT::getTable('fields') . " as p
        WHERE p.id = " . XT::getValue('property_id') . " AND p.lang='" . $GLOBALS['plugin']->getActiveLang() . "'" ,__FILE__,__LINE__,0);

    $data = XT::getQueryData($result);
    XT::assign("DATA", $data[0]);
    // type specific assignments
    switch ($data[0]['type']) {
        case 1:
        $values = explode('[|]',$data[0]['value']);
        $values_used['true'] = $values[0];
        $values_used['false'] = $values[1];
        XT::assign('VALUE',$values_used);
        break;
        case 2:
        if($data[0]['value']!= ""){
            $values = explode('[|]',$data[0]['value']);
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
        case 5:
        if($data[0]['value']!= ""){
            $range = explode('[;]', $data[0]['value']);
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
        case 3:
        $values = explode('[;]',$data[0]['value']);
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
        
        case 9:
        $values = explode('[;]',$data[0]['value']);
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
        $values = explode('[;]',$data[0]['value']);
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
        
        case 10:
        $values = explode('[;]',$data[0]['value']);
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
        case 6:
        XT::assign('TARGET_CONTENT_TYPE', $data[0]['value']);
        // select the dropdown and pickers
        $result = XT::query("SELECT ct.id, ct.title , cp.template
            FROM 
                " .XT::getDatabasePrefix() . "content_types as ct, 
                " . XT::getDatabasePrefix() . "pickers cp
            WHERE 
                cp.content_type = ct.id  
            ",__FILE__,__LINE__);
        $content_types[$relation['source_content_type']]['id'] =  $relation['source_content_type'];
        $content_types[$relation['source_content_type']]['title'] =  'no picker defined (' . $relation['source_content_type'] .')';
        $content_types[$relation['target_content_type']]['id'] =  $relation['target_content_type'];
        $content_types[$relation['target_content_type']]['title'] =  'no picker defined (' . $relation['target_content_type'] .')';

        while ($row = $result->fetchRow()) {
            $content_types[$row['id']] = $row;
        }
        XT::assign("CTYPES", $content_types);
        break;
        
        case 7:
        XT::assign('TARGET_CONTENT_TYPE', $data[0]['value']);
        // select the dropdown and pickers
        $result = XT::query("SELECT ct.id, ct.title , cp.template
            FROM 
                " .XT::getDatabasePrefix() . "content_types as ct, 
                " . XT::getDatabasePrefix() . "pickers cp
            WHERE 
                cp.content_type = ct.id  
            ",__FILE__,__LINE__);
        $content_types[$relation['source_content_type']]['id'] =  $relation['source_content_type'];
        $content_types[$relation['source_content_type']]['title'] =  'no picker defined (' . $relation['source_content_type'] .')';
        $content_types[$relation['target_content_type']]['id'] =  $relation['target_content_type'];
        $content_types[$relation['target_content_type']]['title'] =  'no picker defined (' . $relation['target_content_type'] .')';

        while ($row = $result->fetchRow()) {
            $content_types[$row['id']] = $row;
        }
        XT::assign("CTYPES", $content_types);
        break;
        case 11:
            $newarray = explode('[;]',$data[0]['value']);
            XT::assign('MULTIPLETEXT', $newarray);
            break;
    }


    $result = XT::query("
     SELECT r.id, r.title, (pr.role_id is not null) as allowed FROM " . XT::getDatabasePrefix() . "roles as r LEFT JOIN
    " . XT::getTable('fields_roles') . "  as pr ON(pr.field_id = " . XT::getValue('property_id') . " AND pr.lang='" . $GLOBALS['plugin']->getActiveLang() . "' and pr.role_id = r.id)
    ORDER by r.title asc"
    ,__FILE__,__LINE__,0);

    XT::assign('ROLES',XT::getQueryData($result));
    
    
        
    /**
     * Get group data
     */
    $result = XT::query("SELECT fg.id, fg.lang, fg.name, fg.description,(frel.field_id>0) as selected
        FROM " . XT::getTable("fieldgroups") . " as fg 
        LEFT JOIN " . XT::getTable("fieldgroups_rel") . " as frel ON (frel.fieldgroup_id = fg.id AND frel.field_id=" . XT::getValue('property_id') . ")
        WHERE fg.lang='" . $GLOBALS['plugin']->getActiveLang() . "'
        ORDER by fg.name ASC
    ",__FILE__,__LINE__);
    XT::assign("GROUPS",XT::getQueryData($result));
     
    
    // Fetch content
    $content = XT::build("properties_edit.tpl");
}else{
    XT::log("No Permission \"edit\" (BaseID:" . XT::getBaseID() . ")" ,__FILE__,__LINE__,XT_ERROR);
}

?>
