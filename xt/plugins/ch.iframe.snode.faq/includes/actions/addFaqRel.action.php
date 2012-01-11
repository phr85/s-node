<?php
if(XT::getSessionValue('open') <= 1){
    $GLOBALS['preplugin_content'] .= '<script language="JavaScript"><!--
    alert(\'' . $GLOBALS['lang']->msg('Please choose a category first') . '\');
    //-->
    </script>';
} else {
    if(XT::getValue('alwaysactive') != 1) {
        XT::setValue('alwaysactive',0);
    }
    
    // Add a new FAQ entry
    XT::query("
        INSERT INTO " . XT::getTable('faq') . " (
            date,
            c_user,
            lang
        ) VALUES (
            " . TIME . ",
            " . XT::getUserID() . ",
            '" . XT::getActiveLang() . "'
        )
    ",__FILE__,__LINE__);
    
    $result = XT::query("
        SELECT
            id
        FROM
            " . XT::getTable('faq') . "
        WHERE
            date = '" . TIME . "' AND
            c_user = '" . XT::getUserID()  . "' AND
            lang = '" . XT::getActiveLang() . "'
    ",__FILE__,__LINE__);
    $row = $result->FetchRow();
    $id = $row['id'];
    
    $result = XT::query("
        SELECT
            (MAX(position)+1) as maxpos
        FROM
            " . XT::getTable('faq2cat') . "
    ",__FILE__,__LINE__);
    $row = $result->FetchRow();
    $max_pos = $row['maxpos'];
    
    if(XT::getSessionValue('open') > 0){
        XT::query("INSERT INTO " . XT::getTable('faq2cat') . " (faq_id,node_id,position) 
            VALUES (
            " . $id . ",
            " . XT::getSessionValue('open') . ",
            " . $max_pos . "
        )",__FILE__,__LINE__);
    }
    
    XT::setSessionValue('newid', $id);
    XT::setValue("id", $id);
    XT::setAdminModule("edit");

}

?>