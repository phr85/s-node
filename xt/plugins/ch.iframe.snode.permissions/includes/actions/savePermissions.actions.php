<?php
/**
 * savePermissions':
 */
$perms = 0;
foreach($GLOBALS['plugin']->getValue('user_perms') as $key => $value){
    if($value == 1){
        $perms = $GLOBALS['perm']->addPerm($perms, $key);
    }
}

// Delete previously defined permissions
XT::query("DELETE FROM " . $GLOBALS['cfg']->get("database", "prefix") . "perms WHERE base_id = " . $GLOBALS['plugin']->base_id . " AND user_id = " . $GLOBALS['plugin']->getSessionValue("perm_user"),__FILE__,__LINE__);
XT::query("INSERT INTO " . $GLOBALS['cfg']->get("database", "prefix") . "perms (perms,base_id,user_id,lang)
 VALUES (" . $perms . "," . $GLOBALS['plugin']->base_id . "," . $GLOBALS['plugin']->getSessionValue("perm_user") . ",'" . $GLOBALS['plugin']->getActiveLang() . "')",__FILE__,__LINE__);
header("Location: " . $_SERVER['PHP_SELF'] . "?TPL=" . $GLOBALS['tpl_id']);
?>