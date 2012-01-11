<?php

$result = XT::query("
    SELECT
        count(taxes) as cnt
    FROM
        " . $GLOBALS['plugin']->getTable('price') . "
    WHERE
        taxes = " . $GLOBALS['plugin']->getValue('id')
    ,__FILE__,__LINE__,0);

$row = $result->FetchRow();
if($row['cnt'] > 0){
    XT::log('This value is used in the catalog, cannot be deleted', __FILE__, __LINE__, XT_ERROR);
}

if(!XT::hasErrors()){
    XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('taxes') . " WHERE id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);
    XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('taxes_details') . " WHERE id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);
    XT::log("Value " . $GLOBALS['plugin']->getValue('id') . " has been deleted.",__FILE__,__LINE__,XT_INFO);
}

?>
