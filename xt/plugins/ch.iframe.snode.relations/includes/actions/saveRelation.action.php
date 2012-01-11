<?php
XT::setAdminModule("e");
$continue = true;
if (XT::getValue("source_content_id") == "" || !is_numeric(XT::getValue("source_content_id"))) {
	XT::log("source content id must be numeric", __FILE__, __LINE__, XT_WARNING);
	$continue = false;
}

if (XT::getValue("target_content_id") == "" || !is_numeric(XT::getValue("target_content_id"))) {
	XT::log("Target content id must be numeric", __FILE__, __LINE__, XT_WARNING);
	$continue = false;
}

if (XT::getValue("relation_id") == "") {
	$continue = false;
}

if ($continue) {
    XT::query("
        UPDATE
            " . XT::getTable("relations")  . "
        SET
            content_type ="  . XT::getValue("source_content_type") . ",
            content_id   =" . XT::getValue("source_content_id")  . ",
            target_content_type = " . XT::getValue("target_content_type") . ",
            target_content_id = " . XT::getValue("target_content_id") . ",
            title = '" . XT::getValue("title") . "',
            description = '" . XT::getValue("description") . "'
        WHERE
            id = " . XT::getValue("relation_id") . "
        AND
            lang='" . XT::getLang() . "'"
    ,__FILE__,__LINE__);
    
    if(XT::getValue('double_relation') == 1){
        XT::query("DELETE FROM " . XT::getTable('relations') . " 
        WHERE 
            content_id          = " . XT::getValue("target_content_id")  . "
        AND 
            content_type        = "  . XT::getValue("target_content_type") . "
        AND 
            target_content_id   = " . XT::getValue("source_content_id") ."
        AND 
            target_content_type = " . XT::getValue("source_content_type") . "
        AND
            lang='" . XT::getLang() . "'"
        ,__FILE__,__LINE__);
        XT::query("
        INSERT INTO
            " . XT::getTable("relations")  . "
        SET
            content_type ="  . XT::getValue("target_content_type") . ",
            content_id   =" . XT::getValue("target_content_id")  . ",
            target_content_type = " . XT::getValue("source_content_type") . ",
            target_content_id = " . XT::getValue("source_content_id") .",
            title = '" . XT::getValue("title") . "',
            lang = '" . XT::getLang() . "',
            description = '" . XT::getValue("description") . "'"
    ,__FILE__,__LINE__);
    }
}

?>