<?php
// Register the xt_get_properties_fields template function
$tpl->register_function("xt_get_properties_fields","xt_get_properties_fields");
function xt_get_properties_fields($params){
    // Universelle Eigenschaften mitladen
    if($params['universal']){
        $universal = " OR pmain.content_type = 0";
    }

    if($params['lang']!=''){
    	$lang = $params['lang'];
    }else {
    	$lang = XT::getLang();
    }

    // Verfüegbare eigenschaften holen
    $result = XT::query("
        SELECT
            pdet.property_id as id,
            pdet.title,
            pmain.content_type
        FROM
            " .XT::getDatabasePrefix() . "properties as pmain
        INNER JOIN
            " .XT::getDatabasePrefix() . "properties_details as pdet on(pdet.property_id = pmain.id)

        WHERE
            (pmain.content_type = " . $params['content_type'] . $universal . ") AND
            pdet.lang = '" . $lang . "' AND
            pdet.title != ''

        ORDER BY
            pmain.content_type DESC,
            pmain.position ASC,
            pdet.title ASC"
    ,__FILE__,__LINE__);

    while($row = $result->FetchRow()){
        if($row['content_type'] == 0){
            $properties['props'][$row['id']] = 'U: ' . $row['title'];
        }else{
            $properties['props'][$row['id']] = $row['title'];
        }
    }
    // gruppen holen
    $result = XT::query("
        SELECT
            group_id as id,
            title
        FROM
            " .  XT::getDatabasePrefix() . "properties_groups_details
        WHERE
            lang='" . $lang . "'
    ",__FILE__,__LINE__);

    while ($row = $result->fetchRow()) {
        $properties['groups'][$row['id']] = $row['title'];
    }


    $result = XT::query("
        SELECT
            pval.content_id,
            pval.property_id,
            pval.value,
            pval.level
        FROM
            " . XT::getDatabasePrefix() . "properties_values as pval
        WHERE
            pval.content_id = " .$params['content_id'] . " AND pval.lang = '" . $lang . "'"
    ,__FILE__,__LINE__);

    while($row = $result->FetchRow()){
        $fieldvalues[$row['property_id']][$row['level']] = $row['value'];
    }



    // Ausgefuellte eigenschafen holen (alles)
    $result = XT::query("SELECT
            pval.content_id,
            pdet.description,
            pdet.title as label,
            pval.property_id,
            pmain.type,
            pval.value,
            pmain.value as typevalue,
            pval.level,
            pval.label as fieldlabel
        FROM
            " .  XT::getDatabasePrefix() . "properties_values as pval
        LEFT JOIN
            " .  XT::getDatabasePrefix() . "properties_details as pdet ON (pdet.property_id = pval.property_id AND pval.lang = pdet.lang)
        LEFT JOIN
            " .  XT::getDatabasePrefix() . "properties as pmain ON(pmain.id = pval.property_id)
        WHERE
            pval.content_type = " .$params['content_type'] . " AND pval.content_id = " .$params['content_id'] . " AND pval.lang = '" . $lang . "'
        ORDER BY
            pmain.position ASC",__FILE__,__LINE__);

    $properties['filled'] = XT::getQueryData($result, "property_id");

    foreach ($properties['filled'] as $key => $val){

        // verwendete eigenschaften aus der auswahl entfernen
        unset($properties['props'][$val['property_id']]);
        unset($newarray);
        switch ($val['type']) {

            case 1:
                // bool
                // create array for bool
                $properties['filled'][$key]['preptypevalue'] = explode('[|]',$val['typevalue']);
                break;
            case 11:
                // file

                $properties['filled'][$key]['preptypevalue']['fieldlabel'] = $val['fieldlabel'];
                $properties['filled'][$key]['preptypevalue']['value'] = $val['value'];
                break;

            case 2:
                //number
                $tmp = explode('[|]',$val['typevalue']);
                $tmpmin = explode(':', $tmp[0]);
                $tmpmax = explode(':', $tmp[1]);
                $properties['filled'][$key]['preptypevalue']['min'] = $tmpmin[1];
                $properties['filled'][$key]['preptypevalue']['max'] = $tmpmax[1];
                // format this value
                $properties['filled'][$key]['value'] = $properties['filled'][$key]['value'] * 1;
                break;


            case 3:
                // single dropdown
                $values = explode('[;]',$val['typevalue']);
                $default = false;
                foreach ($values as $dkey => $value) {
                    $line = explode('[|]',$value);
                    if($line[1]==NULL){
                        $line[1] = $line[0];
                    }
                    if($line[0] != NULL){
                        if($line[2] != NULL && $default == false){
                            $newarray[$dkey]['value'] = trim($line[0]);
                            $newarray[$dkey]['label'] = trim($line[1]);
                            $newarray[$dkey]['default'] = 1;
                            $default = true;
                        }else{
                            $newarray[$dkey]['value'] = trim($line[0]);
                            $newarray[$dkey]['label'] = trim($line[1]);
                            $newarray[$dkey]['default'] = 0;

                        }
                    }
                }
                $properties['filled'][$key]['preptypevalue'] = $newarray;
                $properties['filled'][$key]['value'] = $fieldvalues[$val['property_id']][1];
                break;
            case 5:
                // number range
                $range = explode(';',$val['typevalue']);
                //left number
                $tmp = explode('[|]',$range[0]);
                $tmpmin = explode(':', $tmp[0]);
                $tmpmax = explode(':', $tmp[1]);
                $properties['filled'][$key]['preptypevalue']['l']['min'] = $tmpmin[1];
                $properties['filled'][$key]['preptypevalue']['l']['max'] = $tmpmax[1];
                //right number
                $tmp = explode('[|]',$range[1]);

                $tmpmin = explode(':', $tmp[0]);
                $tmpmax = explode(':', $tmp[1]);
                $properties['filled'][$key]['preptypevalue']['r']['min'] = $tmpmin[1];
                $properties['filled'][$key]['preptypevalue']['r']['max'] = $tmpmax[1];
                // format this value
                $properties['filled'][$key]['decimal1'] =$fieldvalues[$val['property_id']][1] * 1;;
                $properties['filled'][$key]['decimal2'] =$fieldvalues[$val['property_id']][2] * 1;;
                break;
            case 6:
                $result = XT::query("
                    SELECT
                        cp.template
                    FROM
                        " . XT::getDatabasePrefix() . "pickers cp
                    WHERE
                        cp.content_type = '" . $properties['filled'][$key]['typevalue'] . "'
                    LIMIT 1
                    ",__FILE__,__LINE__);

                while ($row = $result->fetchRow()) {
                    $properties['filled'][$key]['value'] = $row['template'];
                }

                $result = XT::query("SELECT
                    pval.value,
                    pval.level,
                    pval.label as fieldlabel
                FROM
                    " .  XT::getDatabasePrefix() . "properties_values as pval
                WHERE
                    pval.property_id = " . $val['property_id'] . " AND
                    pval.content_type = " .$params['content_type'] . " AND
                    pval.content_id = " .$params['content_id'] . " AND
                    pval.lang = '" . $lang . "' AND
                    pval.value != ''
                ORDER BY
                    pval.level ASC
                ",__FILE__,__LINE__);

                $proplevelvals = XT::getQueryData($result);

                foreach($proplevelvals as $preptypevalue) {
                    $properties['filled'][$key]['preptypevalue'][$preptypevalue['level']]['level'] = $preptypevalue['level'];
                    $properties['filled'][$key]['preptypevalue'][$preptypevalue['level']]['fieldlabel'] = $preptypevalue['fieldlabel'];
                    $properties['filled'][$key]['preptypevalue'][$preptypevalue['level']]['value'] = $preptypevalue['value'];

                }
                break;
            case 7:
                $result = XT::query("
                    SELECT
                        cp.template
                    FROM
                        " . XT::getDatabasePrefix() . "pickers cp
                    WHERE
                        cp.content_type = '" . $properties['filled'][$key]['typevalue'] . "'
                    LIMIT 1
                    ",__FILE__,__LINE__);

                while ($row = $result->fetchRow()) {
                    $properties['filled'][$key]['value'] = $row['template'];
                }

                $result = XT::query("SELECT
                    pval.value,
                    pval.level,
                    pval.label as fieldlabel
                FROM
                    " .  XT::getDatabasePrefix() . "properties_values as pval
                WHERE
                    pval.property_id = " . $val['property_id'] . " AND
                    pval.content_type = " .$params['content_type'] . " AND
                    pval.content_id = " .$params['content_id'] . " AND
                    pval.lang = '" . $lang . "' AND
                    pval.value != ''
                ORDER BY
                    pval.level ASC
                ",__FILE__,__LINE__);

                $proplevelvals = XT::getQueryData($result);

                foreach($proplevelvals as $preptypevalue) {
                    $properties['filled'][$key]['preptypevalue'][$preptypevalue['level']]['level'] = $preptypevalue['level'];
                    $properties['filled'][$key]['preptypevalue'][$preptypevalue['level']]['fieldlabel'] = $preptypevalue['fieldlabel'];
                    $properties['filled'][$key]['preptypevalue'][$preptypevalue['level']]['value'] = $preptypevalue['value'];

                }
                break;
            case 9:
                // single dropdown
                $values = explode('[;]',$val['typevalue']);
                $default = false;
                foreach ($values as $dkey => $value) {
                    $line = explode('[|]',$value);
                    if($line[1]==NULL){
                        $line[1] = $line[0];
                    }
                    if($line[0] != NULL){
                        if($line[2] != NULL && $default == false){
                            $newarray[$dkey]['value'] = trim($line[0]);
                            $newarray[$dkey]['label'] = trim($line[1]);
                            $newarray[$dkey]['default'] = 1;
                            $default = true;
                        }else{
                            $newarray[$dkey]['value'] = trim($line[0]);
                            $newarray[$dkey]['label'] = trim($line[1]);
                            $newarray[$dkey]['default'] = 0;

                        }
                    }
                }
                $properties['filled'][$key]['preptypevalue'] = $newarray;
                $properties['filled'][$key]['value'] = $fieldvalues[$val['property_id']][1];
                break;

            case 4||10:
                // multi dropdown
                $selected = array();
                $selected = explode(';',$val['value']);
                $values = explode('[;]',$val['typevalue']);
                foreach ($values as $dkey => $value) {
                    $line = explode('[|]',$value);
                    if($line[1]==NULL){
                        $line[1] = $line[0];
                    }
                    // if no value given, use defaults from the element

                    if($fieldvalues[$val['property_id']][1] == ""){
                        if($line[0] != NULL){
                            if($line[2] == 'default'){
                                $newarray[$dkey]['value'] = trim($line[0]);
                                $newarray[$dkey]['label'] = trim($line[1]);
                                $newarray[$dkey]['default'] = 1;
                            }else{

                                $newarray[$dkey]['value'] = trim($line[0]);
                                $newarray[$dkey]['label'] = trim($line[1]);
                                $newarray[$dkey]['default'] = 0;
                            }
                        }
                    }else {

                        if(in_array(trim($line[0]),$fieldvalues[$val['property_id']])){
                            $newarray[$dkey]['value'] = trim($line[0]);
                            $newarray[$dkey]['label'] = trim($line[1]);
                            $newarray[$dkey]['default'] = 1;
                        }else{
                            $newarray[$dkey]['value'] = trim($line[0]);
                            $newarray[$dkey]['label'] = trim($line[1]);
                            $newarray[$dkey]['default'] = 0;
                        }
                    }
                }
                $properties['filled'][$key]['preptypevalue'] = $newarray;
                break;
        }
    }
     if (isset($params['assign'])) {
            XT::assign($params['assign'],$properties);
            // damit keine daten von einem vorherigen aufruf her kommen
            XT::clear_assign("PROPERTIES");
        } else {
            XT::assign("PROPERTIES", $properties);
        }

}

// Register the xt_properties template function
$tpl->register_function("xt_properties","xt_properties");
function xt_properties($params) {
    if (isset($params['content_id']) && (isset($params['properties']) || isset($params['groups']) )) {
        // If no content type is set, take 0 for all
        if ($params['content_type'] == "") {
            $params['content_type'] = 0;
        }
        if(isset($params['lang']) && array_key_exists($params['lang'], $GLOBALS["cfg"]->_languages)) {
            $lang = $params['lang'];
        }
        else {
            $lang = XT::getLang();
        }
        // reset properties array
        $properties = array();
        $properties_group = array();
        // make an array of all groups, separeted with commas
        if (isset($params['groups'] )) {
            $properties_group = XT::getQueryData(XT::query("SELECT property_id FROM " .  XT::getDatabasePrefix() . "properties_group2properties WHERE group_id in (" . $params['groups'] . ")",__FILE__,__LINE__),"property_id");
        }
        foreach ($properties_group as $property_id) {
        	$properties[$property_id['property_id']] = $property_id['property_id'];
        }
        // make an array of all properties, separeted with commas
        if (isset($params['properties'] )) {
            foreach (explode(",",$params['properties']) as $property_id) {
                $properties[$property_id] = $property_id;
            }
        }

        $data=array();
        // Get properties details
        $result = XT::query("SELECT
                    pdet.description,
                    pdet.title as label,
                    pmain.id as property_id,
                    pmain.type,
                    pmain.value as typevalue
               FROM
                    " .  XT::getDatabasePrefix() . "properties as pmain
               LEFT JOIN
                    " .  XT::getDatabasePrefix() . "properties_details as pdet ON (pdet.property_id = pmain.id AND pdet.lang = '" . $lang . "')
               WHERE
                    pmain.id in (" . implode(", ",$properties) . ") AND pmain.content_type in (0," . $params['content_type'] . ")
                ORDER BY
                    pmain.position
                ",__FILE__,__LINE__);
        $data = XT::getQueryData($result,"property_id");
        $unset = $data;
        // Get properties data
        $result = XT::query("SELECT
		      	   pval.content_id,
	               pval.value,
	               pval.level,
	               pval.label,
	               pval.property_id
		       FROM
		           " .  XT::getDatabasePrefix() . "properties_values as pval
		       WHERE
		           pval.property_id in(" . implode(", ",$properties) . ") AND pval.content_id = " .$params['content_id'] . " AND pval.lang = '" . $lang . "' AND pval.content_type=" . $params['content_type'],__FILE__,__LINE__);

        while($row = $result->FetchRow()){
            $data[$row['property_id']]['data'][$row['level']] =$row;
            unset($unset[$row['property_id']]);
        }
        foreach ($unset as $remove => $unused) {
        	unset($data[$remove]);
        }
        // Assign data
        if (isset($params['assign'])) {
            XT::assign($params['assign'],$data);
            // damit keine daten von einem vorherigen aufruf her kommen
            XT::clear_assign("XT_PROPERTIES");
        } else {
            if(count($data) > 0){
                XT::assign("XT_PROPERTIES",$data);
            }else{
                XT::clear_assign("XT_PROPERTIES");
            }
        }
    } else {
        echo "NO content_id, properties or groups set";
    }
}

?>