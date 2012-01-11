<?php

$perms = 0;
foreach($GLOBALS['plugin']->getValue('perms') as $key => $value){
    if($value == 1){
        $perms = $GLOBALS['perm']->addPerm($perms, $key);
    }
}
// Delete previously defined permissions
XT::query("
    DELETE FROM
        " . $GLOBALS['plugin']->getTable($GLOBALS['plugin']->getSessionValue("perm_mode") . '_perms') . "
    WHERE
        node_id = " . $GLOBALS['plugin']->getSessionValue("node_id") . "
        AND " . $GLOBALS['plugin']->getSessionValue("perm_mode") . "_id = " . $GLOBALS['plugin']->getValue("perm_id") . "
        AND lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
    ",__FILE__,__LINE__);

XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable($GLOBALS['plugin']->getSessionValue("perm_mode") . '_perms') . " (" . $GLOBALS['plugin']->getSessionValue("perm_mode") . "_id,node_id,lang,rights)
 VALUES (" . $GLOBALS['plugin']->getValue("perm_id") . "," . $GLOBALS['plugin']->getSessionValue("node_id") . ",'" . $GLOBALS['plugin']->getActiveLang() . "'," . $perms . ")",__FILE__,__LINE__);
header("Location: " . $_SERVER['PHP_SELF'] . "?TPL=" . $GLOBALS['tpl_id']);

?>