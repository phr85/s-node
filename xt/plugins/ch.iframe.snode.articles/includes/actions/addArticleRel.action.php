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
	// Add a News
    XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('articles') . " (creation_date,creation_user,lang, active) VALUES (" . time() . "," . XT::getUserID() . ",'" . $GLOBALS['plugin']->getActiveLang() . "'," . XT::getValue('alwaysactive')  . ")",__FILE__,__LINE__);

    $result = XT::query("SELECT MAX(id) as maxid FROM " . $GLOBALS['plugin']->getTable('articles'),__FILE__,__LINE__);
    $row = $result->FetchRow();

    // Add a new revision
    XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('articles_v') . " (id, creation_date,creation_user,lang, active) VALUES (" . $row['maxid'] . "," . time() . "," . XT::getUserID() . ",'" . $GLOBALS['plugin']->getActiveLang() . "'," . XT::getValue('alwaysactive')  . ")",__FILE__,__LINE__);

    // Add category relation
    if(XT::getSessionValue('open') > 0){
        XT::query("INSERT INTO " . XT::getTable('articles_tree_rel') . " (article_id,node_id) VALUES (" . $row['maxid'] . "," . XT::getSessionValue('open') . ")",__FILE__,__LINE__);
    }
	XT::setSessionValue('newid',$row['maxid']);
    $GLOBALS['plugin']->setValue("id", $row['maxid']);
    $GLOBALS['plugin']->setValue("rid", 1);
    $GLOBALS['plugin']->setAdminModule("e");

}
?>