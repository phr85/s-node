<?php

$result = XT::query("
    SELECT
        tpl_file
    FROM
        " . $GLOBALS['plugin']->getTable("navigation_details") . "
    WHERE
        node_id = " . $GLOBALS['plugin']->getSessionValue('node_id') . "
        AND lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
");

$data = array();
while($row = $result->FetchRow()){
    if(file_exists(PAGES_DIR . $row['tpl_file'])){
        
        $tpl_content = file_get_contents(PAGES_DIR . $row['tpl_file']);
        
        XT::addImageButton("[S]ave", "saveTemplate","default","disk_blue.png","0","","s");
        XT::addImageButton("Save and close", "saveTemplateAndClose","default","save_close.png","0","","x");

        XT::assign("TPL_CONTENT",$tpl_content);
        XT::assign("TPL_FILE",$row['tpl_file']);
        
    } else {
        XT::log('File doesn\'t exist',__FILE__,__LINE__,XT_ERROR);
    }
}

XT::assign("NODE_ID", XT::getSessionValue("node_id"));
XT::assign("ACTIVE_LANG", XT::getPluginLang());
$content = XT::build("editTemplate.tpl");

?>
