<?php
$perms = 0;
foreach($GLOBALS['plugin']->getValue('perms') as $key => $value){
    if($value == 1){
        $perms = $GLOBALS['perm']->addPerm($perms, $key);
    }
}

// Get principal type
switch($GLOBALS['plugin']->getValue("mode")){
    case 'user':
        $principal_type = 1;
        break;
    case 'group':
        $principal_type = 2;
        break;
    case 'role':
        $principal_type = 3;
        break;
}

// Delete previously defined permissions
XT::query("
    DELETE FROM 
        " . $GLOBALS['cfg']->get("database", "prefix") . "perms 
    WHERE 
        base_id = " . $GLOBALS['plugin']->getValue("base_id") . "
        AND principal_id = " . $GLOBALS['plugin']->getValue($GLOBALS['plugin']->getValue("mode") . "_id") . "
        AND principal_type = " . $principal_type . "
        AND lang = '" . $GLOBALS['plugin']->getValue("save_lang") . "'
    ",__FILE__,__LINE__);
    
XT::query("
    INSERT INTO 
        " . $GLOBALS['cfg']->get("database", "prefix") . "perms 
    (
        base_id,
        principal_id,
        principal_type,
        perms,
        lang
    ) VALUES (
        " . $GLOBALS['plugin']->getValue("base_id") . ",
        " . $GLOBALS['plugin']->getValue($GLOBALS['plugin']->getValue("mode") . "_id") . ",
        " . $principal_type . ",
        " . $perms . ",
        '" . $GLOBALS['plugin']->getValue("save_lang") . "'
    )",__FILE__,__LINE__,1);
   
?>
