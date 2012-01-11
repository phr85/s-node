<?php

if($GLOBALS['plugin']->getValue("element_id") != ''){
    $GLOBALS['plugin']->setSessionValue("element_id", $GLOBALS['plugin']->getValue("element_id"));
}

$result = XT::query("
    SELECT
        *
    FROM
        " . $GLOBALS['plugin']->getTable("forms_elements") .  "
    WHERE
        element_id = " . $GLOBALS['plugin']->getSessionValue("element_id") . "
    ",__FILE__,__LINE__);

$data = XT::getQueryData($result);
XT::assign("DATA", $data[0]);

// Get element rules
$result = XT::query("
    SELECT
        *
    FROM
        " . $GLOBALS['plugin']->getTable("forms_elements_rules") .  "
    WHERE
        element_id = " . $GLOBALS['plugin']->getSessionValue("element_id") . "
    ",__FILE__,__LINE__);

$data = XT::getQueryData($result);
XT::assign("RULES", $data);

// Get element values
$result = XT::query("
    SELECT
        *
    FROM
        " . $GLOBALS['plugin']->getTable("forms_elements_values") .  "
    WHERE
        element_id = " . $GLOBALS['plugin']->getSessionValue("element_id") . "
    ORDER BY
        pos ASC
    ",__FILE__,__LINE__);

$data = XT::getQueryData($result);
XT::assign("VALUES", $data);

// If something should be added
if($GLOBALS['plugin']->getSessionValue("ctrl_add_value") != ''){
    $GLOBALS['plugin']->contribute("edit_element_values_buttons", "Cancel", "cancelAddValue","cancel.png","0");
} else {
    if(sizeof($data) > 0){
        $GLOBALS['plugin']->contribute("edit_element_values_buttons", "Add custom value", "addValue","add_small.png","0");
    } else {
        $GLOBALS['plugin']->contribute("edit_element_values_buttons", "Add custom value", "addFirstValue","add_small.png","0");
        XT::assign("FIRST_VALUE", true);
    }
}
$GLOBALS['plugin']->getSessionValue("ctrl_add_value") == 1 ? XT::assign("CTRL", 1) : XT::assign("CTRL", 0);

// Assign available element types
XT::assign("TYPES", $GLOBALS['plugin']->getConfig('field_types'));

$content = XT::build("editElement.tpl");

?>
