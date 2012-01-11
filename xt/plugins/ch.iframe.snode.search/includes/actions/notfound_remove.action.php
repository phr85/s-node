<?php
/**
 * Delete Notfound entry
 */
// find word
$result = XT::query("
    SELECT
        kw
    FROM
        " . $GLOBALS['plugin']->getTable('search_notfound') . "
    WHERE
        id = " . $GLOBALS['plugin']->getValue('id')
    ,__FILE__,__LINE__);
while($row = $result->FetchRow()){
    $word = $row['kw'];
}
// delete word
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('search_notfound') . " WHERE kw ='" . $word . "'",__FILE__,__LINE__);
XT::log("Keyword " . $word . " has been deleted ",__FILE__,__LINE__,XT_INFO);
XT::setAdminModule('nf');
?>
