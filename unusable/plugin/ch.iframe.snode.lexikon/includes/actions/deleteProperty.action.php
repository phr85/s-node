<?php
$count = XT::getQueryData(XT::query("SELECT count(article_id) as count FROM " . $GLOBALS['plugin']->getTable('fields') . "
                                    where fieldname_id=" . $GLOBALS['plugin']->getValue('property_id'),__FILE__,__LINE__,0));
if($count[0]['count'] < 1){
    XT::query("DELETE FROM
                   " . $GLOBALS['plugin']->getTable('fieldnames') . "
               WHERE
                   id=" . $GLOBALS['plugin']->getValue('property_id')
                   ,__FILE__,__LINE__);
    XT::log("Property " . $GLOBALS['plugin']->getValue('property_id') . " <b>deleted</b>",__FILE__,__LINE__,XT_INFO);
}else{
    XT::log("Property " . $GLOBALS['plugin']->getValue('property_id') . " id in use",__FILE__,__LINE__,XT_INFO);
}
?>
