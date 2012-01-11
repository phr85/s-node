<?php
if(XT::getSessionValue('open') <= 1){

    $GLOBALS['preplugin_content'] .= '<script language="JavaScript"><!--
alert(\'' . $GLOBALS['lang']->msg('Please choose a category first') . '\');
//-->
</script>';
} else {

    // Add a News
    XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('newsmanager') . " (creation_date,creation_user,lang) VALUES (" . time() . "," . XT::getUserID() . ",'" . $GLOBALS['plugin']->getActiveLang() . "')",__FILE__,__LINE__);

    $result = XT::query("SELECT MAX(id) as maxid FROM " . $GLOBALS['plugin']->getTable('newsmanager'),__FILE__,__LINE__);
    $row = $result->FetchRow();

    // Add a new revision
    XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('newsmanager_v') . " (id, creation_date,creation_user,lang) VALUES (" . $row['maxid'] . "," . time() . "," . XT::getUserID() . ",'" . $GLOBALS['plugin']->getActiveLang() . "')",__FILE__,__LINE__);

    // Add category relation
    if(XT::getSessionValue('open') > 0){
        XT::query("INSERT INTO " . XT::getTable('newsmanager_tree_rel') . " (news_id,node_id) VALUES (" . $row['maxid'] . "," . XT::getSessionValue('open') . ")",__FILE__,__LINE__);
    }

    $GLOBALS['plugin']->setValue("id", $row['maxid']);
    $GLOBALS['plugin']->setValue("rid", 1);
    $GLOBALS['plugin']->setAdminModule("e");

}
?>