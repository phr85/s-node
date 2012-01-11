<?php
if(XT::getPermission('editObject')){
    XT::addImageButton('Save', 'saveObject', 'default',"disk_blue.png","edit");
}

$result = XT::query("
    SELECT
        *
    FROM 
        " . $GLOBALS['plugin']->getTable('content_types') . "
    WHERE
        id = " . XT::getSessionValue('object_id')
, __FILE__, __LINE__);

$data = $result->fetchRow();
XT::assign('DATA', $data);
$content = XT::build('edit.tpl');
?>