<?php
if(!XT::hasErrors()){
    XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('units') . " WHERE id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);
    XT::log("Unit " . $GLOBALS['plugin']->getValue('id') . " has been deleted.",__FILE__,__LINE__,XT_INFO);
}
?>