<?php

if($GLOBALS['plugin']->getValue("value_id") != ''){
    $GLOBALS['plugin']->setSessionValue("value_id", $GLOBALS['plugin']->getValue("value_id"));
}

$result = XT::query("
    SELECT
        *
    FROM
        " . $GLOBALS['plugin']->getTable("forms_elements_values") .  "
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue("value_id") . "
    ",__FILE__,__LINE__);
    
$data = XT::getQueryData($result);
XT::assign("DATA", $data[0]);

$content = XT::build("editElementValue.tpl");

?>
