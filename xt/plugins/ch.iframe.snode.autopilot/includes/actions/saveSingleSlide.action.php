<?php
$_SERVER['PHP_SELF'];
if(is_numeric(XT::getValue("page"))){
    XT::setValue("page", $_SERVER['PHP_SELF'] . '?TPL=' . XT::getValue("page"));
}
XT::query("
    UPDATE
        " . XT::getTable("autopilot_data") . "
    SET
        page = '" . XT::getValue("page") . "',
        page_type = '" . XT::getValue("page_type") . "',
        comment = '" . XT::getValue("comment") . "',
        duration = '" . XT::getValue("duration") . "'
    WHERE 
        id = " . XT::getSessionValue("slide_id") . "
    AND
        position = " . XT::getValue("position"),__FILE__,__LINE__);

?>