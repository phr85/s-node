<?php
if(XT::getSessionValue('open') <= 1){

    $GLOBALS['preplugin_content'] .= '<script language="JavaScript"><!--
alert(\'' . $GLOBALS['lang']->msg('Please choose a category first') . '\');
//-->
</script>';
} else {

    // Add a News
    XT::query("
        INSERT INTO 
            " . XT::getTable('events') . " 
        (
            from_date
        ) VALUES (
            " . time() . "
        )"
    ,__FILE__,__LINE__);

    $result = XT::query("
        SELECT 
            MAX(id) as maxid 
        FROM    
            " . XT::getTable('events')
    ,__FILE__,__LINE__);
    
    $row = $result->fetchRow();

    XT::query("
        INSERT INTO 
            " . XT::getTable("events_details") . "
            (id, active, lang, creation_date, creation_user)
        VALUES
            (" . $row['maxid'] . ", 0, '" . XT::getPluginLang() . "', " . time() . ", " . XT::getUserID() . ")
    ",__FILE__,__LINE__);
    
    // Add category relation
    if(XT::getSessionValue('open') > 0){
        XT::query("
            INSERT INTO 
                " . XT::getTable('events_tree_rel') . " 
                (event_id,node_id) VALUES (" . $row['maxid'] . "," . XT::getSessionValue('open') . ")"
        ,__FILE__,__LINE__);
        
    }

    XT::setValue("id", $row['maxid']);
    XT::setAdminModule("e");
}
?>