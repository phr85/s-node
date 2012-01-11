<?php

$params = stripslashes($GLOBALS['plugin']->getValue("params",true));

XT::query("UPDATE " . $GLOBALS['plugin']->getTable("forms_elements") .  "
    SET
        label = '" . $GLOBALS['plugin']->getValue("label") . "',
        description = '" . $GLOBALS['plugin']->getValue("description") . "',
        required = '" . $GLOBALS['plugin']->getValue("required") . "',
        required_msg = '" . $GLOBALS['plugin']->getValue("required_msg") . "',
        default_value = '" . $GLOBALS['plugin']->getValue("default_value") . "',
        datasource_type = '" . $GLOBALS['plugin']->getValue("datasource_type") . "',
        datasource_query = '" . $GLOBALS['plugin']->getValue("datasource_query") . "',
        element_type = '" . $GLOBALS['plugin']->getValue("element_type") . "',
        datasource_label_field = '" . $GLOBALS['plugin']->getValue("datasource_label_field") . "',
        datasource_value_field = '" . $GLOBALS['plugin']->getValue("datasource_value_field") . "',
        readonly = '" . $GLOBALS['plugin']->getValue("readonly") . "',
        scripting_identifier = '" . $GLOBALS['plugin']->getValue("scripting_identifier") . "',
        size = '" . $GLOBALS['plugin']->getValue("size") . "',
		maxlength = '" . $GLOBALS['plugin']->getValue("maxlength") . "',
        params = '" . $params . "',
        hide_label = '" . $GLOBALS['plugin']->getValue("hide_label") . "'
    WHERE
        element_id = '" . $GLOBALS['plugin']->getValue("element_id") . "'
    ",__FILE__,__LINE__);
    
$GLOBALS['plugin']->setAdminModule("ee");

?>
