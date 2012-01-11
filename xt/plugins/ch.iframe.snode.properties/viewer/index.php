<?php
// Parameter :: Style
$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';

$property_id = XT::getParam('property') != '' ? XT::getParam('property') : NULL;

$property_group = XT::getParam('group') != '' ? XT::getParam('group') : NULL;

$selected = XT::getValue("property");

// IDs der Eigenschaften der gruppen holen
if(!is_null($property_group)){
    $result = XT::query("
    SELECT
        property_id
    FROM
        " . XT::getTable("prop2group") ."
    WHERE
        group_id in(" . $property_group . ")" ,__FILE__,__LINE__);
    while($group = $result->FetchRow()){
        if(is_null($property_id)){
            $property_id .=$group['property_id'];
        }else{
            $property_id .=", " . $group['property_id'];
        }
    }
}

$result = XT::query("
    SELECT
        pmain.id,
        pmain.content_type,
        pmain.position,
        pmain.type,
        pmain.value,
        pmain.public,
        pdet.title,
        pdet.description
    FROM
        " . XT::getTable("properties") ." as pmain
    LEFT JOIN
        " . XT::getTable("details") ." as pdet on (pmain.id = pdet.property_id AND pdet.lang='" . XT::getLang() . "')
    WHERE
        pmain.id in(" . $property_id . ")" ,__FILE__,__LINE__);

$data = array();
while($propertyData = $result->FetchRow()){
    unset($newarray);
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
            $propertyData['data'] = $tmp;
            $data[$propertyData['id']]= $propertyData;
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

                $propertyData['data'] = $numbers;
                $data[$propertyData['id']]= $propertyData;

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
            $propertyData['data'] = $newarray;
            $data[$propertyData['id']]= $propertyData;
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

            // bei sortierung
            if(XT::getParam("sorted")){
                foreach ($newarray as $key => $value) {
                    $tmparray[] = $value['label'];
                }
                asort($tmparray);
                foreach ($tmparray as $key => $value) {
                    $sortedarray[$key] = $newarray[$key];
                }

                $propertyData['data'] = $sortedarray;
            }else {
                $propertyData['data'] = $newarray;
            }


            $data[$propertyData['id']]= $propertyData;

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
                $propertyData['data'] = $numbers;
                $data[$propertyData['id']]= $propertyData;
            }
            break;

        case 6:
            // Don't know what to do :-O
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
            $propertyData['data'] = $newarray;
            $data[$propertyData['id']]= $propertyData;
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

            $propertyData['data'] = $newarray;
            $data[$propertyData['id']]= $propertyData;

            break;
    }
}

$data['selected'] = $selected;

XT::assign("xt" . XT::getBaseID() . "_viewer",$data);

// build content
$content = XT::build($style);

XT::clear_assign("xt" . XT::getBaseID() . "_viewer");
?>