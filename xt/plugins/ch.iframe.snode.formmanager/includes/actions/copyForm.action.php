<?php

$bad_sign = "'";
$good_sign = "\'";

if(!function_exists("recursive_str_replace")) {
    function recursive_str_replace ($search, $replace, $array) {
        if(is_array($array)) {
            foreach($array as $key => $value) {
                if(is_array($value)) {
                    $tmparray[$key] = recursive_str_replace($search, $replace, $value);
                }
                else {
                    $tmparray[$key] = str_replace($search, $replace, $value);
                }
            }
            return($tmparray);
        }
        else {
            str_replace($search, $replace, $array);
        }
    }
}

// Copy main form data
$result = XT::query("SELECT * FROM " . XT::getTable('forms') . " WHERE id = '" . $GLOBALS['plugin']->getValue('form_id') . "'",__FILE__,__LINE__);
while($row = $result->FetchRow()){
    $row = recursive_str_replace($bad_sign, $good_sign, $row);
    XT::query("
        INSERT INTO
            " . XT::getTable('forms') . "
        (
            title,
            active,
            lang,
            layout,
			description,
			identifier,
			hide_label
        ) VALUES (
            '*copy* " . $row['title'] . "',
            '" . $row['active'] . "',
            '" . $row['lang'] . "',
            '" . $row['layout'] . "',
			'" . $row['description'] . "',
			'" . $row['identifier'] . "',
			'" . $row['hide_label'] . "'
        )"
    ,__FILE__,__LINE__);
}

// Get id of the new form
$result = XT::query("SELECT id FROM " . XT::getTable('forms') . " ORDER BY id DESC LIMIT 1",__FILE__,__LINE__);
while($row = $result->FetchRow()){
    $newid = $row['id'];
    
    // Copy Properties
    if (XT::getConfig('display_properties') == true) {
    	// Set the content type
    	XT::setValue("XT_PROP_content_type",XT::getContentType('Form'));
    	// Set the original content_id
    	XT::setValue('XT_PROP_content_id',XT::getValue('form_id'));
    	// Set the new content_id
    	XT::setValue('XT_PROP_target_content_id',$newid);
    	// call the copy proces
    	XT::call('ch.iframe.snode.properties.copyPropertyValues');
    }
}

// Copy elements
$elements_old = array();
$result = XT::query("SELECT * FROM " . XT::getTable('forms_elements') . " WHERE form_id = '" . $GLOBALS['plugin']->getValue('form_id') . "' ORDER BY element_id ASC",__FILE__,__LINE__);
while($row = $result->FetchRow()){
    $row = recursive_str_replace($bad_sign, $good_sign, $row);
    XT::query("
        INSERT INTO
            " . XT::getTable('forms_elements') . "
        (
            element_type,
            form_id,
            pos,
            required,
            required_msg,
            active,
            description,
            datasource,
            datasource_type,
            datasource_label_field,
            datasource_value_field,
            lang,
            label,
            default_value,
            datasource_query,
            readonly,
            size,
            maxlength,
            params,
            scripting_identifier,
			hide_label
        ) VALUES (
            '" . $row['element_type'] . "',
            '" . $newid . "',
            '" . $row['pos'] . "',
            '" . $row['required'] . "',
            '" . $row['required_msg'] . "',
            '" . $row['active'] . "',
            '" . $row['description'] . "',
            '" . $row['datasource'] . "',
            '" . $row['datasource_type'] . "',
            '" . $row['datasource_label_field'] . "',
            '" . $row['datasource_value_field'] . "',
            '" . $row['lang'] . "',
            '" . $row['label'] . "',
            '" . $row['default_value'] . "',
            '" . $row['datasource_query'] . "',
            '" . $row['readonly'] . "',
            '" . $row['size'] . "',
            '" . $row['maxlength'] . "',
            '" . $row['params'] . "',
            '" . $row['scripting_identifier'] . "',
			'" . $row['hide_label'] . "'
        )"
    ,__FILE__,__LINE__);
    $elements_old[] = $row['element_id'];
}

// Get new ids of the new form elements
$result = XT::query("SELECT element_id FROM " . XT::getTable('forms_elements') . " WHERE form_id = '" . $newid . "' ORDER BY element_id ASC",__FILE__,__LINE__);
$count = 0;
while($row = $result->FetchRow()){
    $elements[$elements_old[$count]] = $row['element_id'];
    $count++;
}

// Copy form actions
$result = XT::query("SELECT * FROM " . XT::getTable('forms_actions') . " WHERE form_id = '" . $GLOBALS['plugin']->getValue('form_id') . "'",__FILE__,__LINE__);
while($row = $result->FetchRow()){
    $row = recursive_str_replace($bad_sign, $good_sign, $row);
    XT::query("
        INSERT INTO
            " . XT::getTable('forms_actions') . "
        (
            form_id,
            type,
            value,
            pos,
            lang
        ) VALUES (
            '" . $newid . "',
            '" . $row['type'] . "',
            '" . $row['value'] . "',
            '" . $row['pos'] . "',
            '" . $row['lang'] . "'
        )"
    ,__FILE__,__LINE__);
}

// Copy form element rules
$result = XT::query("SELECT * FROM " . XT::getTable('forms_elements_rules') . " WHERE form_id = '" . $GLOBALS['plugin']->getValue('form_id') . "' ORDER BY element_id ASC",__FILE__,__LINE__);
while($row = $result->FetchRow()){
    $row = recursive_str_replace($bad_sign, $good_sign, $row);
    XT::query("
        INSERT INTO
            " . XT::getTable('forms_elements_rules') . "
        (
            form_id,
            element_id,
            compare_query,
            compare_type,
            value_field,
            value_query,
            value_type,
            value,
            title,
            lang,
            error_msg
        ) VALUES (
            '" . $newid . "',
            '" . $elements[$row['element_id']] . "',
            '" . $row['compare_query'] . "',
            '" . $row['compare_type'] . "',
            '" . $row['value_field'] . "',
            '" . $row['value_query'] . "',
            '" . $row['value_type'] . "',
            '" . $row['value'] . "',
            '" . $row['title'] . "',
            '" . $row['lang'] . "',
            '" . $row['error_msg'] . "'
        )"
    ,__FILE__,__LINE__);
}

// Copy form element values
if(sizeof($elements_old) > 0){
    $result = XT::query("SELECT * FROM " . XT::getTable('forms_elements_values') . " WHERE element_id IN (" . implode(',',$elements_old) . ") ORDER BY element_id ASC",__FILE__,__LINE__);
    while($row = $result->FetchRow()){
        $row = recursive_str_replace($bad_sign, $good_sign, $row);
        XT::query("
            INSERT INTO
                " . XT::getTable('forms_elements_values') . "
            (
                element_id,
                label,
                value,
                pos
            ) VALUES (
                '" . $elements[$row['element_id']] . "',
                '" . $row['label'] . "',
                '" . $row['value'] . "',
                '" . $row['pos'] . "'
            )"
        ,__FILE__,__LINE__);
    }
}
?>