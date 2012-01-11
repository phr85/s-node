<?php

// Get script id
if(XT::getValue("script_id") != ''){
    XT::setSessionValue("script_id", XT::getValue("script_id"));
}

// Add buttons
XT::addImageButton('Save','saveScript','default','disk_blue.png','0');

// Get addresses
$result = XT::query("
    SELECT
        *
    FROM
        " . XT::getTable('forms_scripts') . "
    WHERE
        id = " . XT::getSessionValue('script_id') . "
");

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

if(is_file(DATA_DIR . 'scripts/ch.iframe.snode.formmanager/' . $data[0]['id'] . '.php')){
    $data[0]['content'] = file_get_contents(DATA_DIR . 'scripts/ch.iframe.snode.formmanager/' . $data[0]['id'] . '.php');
    $data[0]['content_highlighted'] = highlight_string($data[0]['content'],true);
} else {
    XT::log('Cannot read file',__FILE__,__LINE__,XT_ERROR);
}

XT::assign("SCRIPT", $data[0]);

$content = XT::build('editScript.tpl');

?>