<?php

// save standard
XT::query("UPDATE " . $GLOBALS['plugin']->getTable('taxes') . " SET value= '" . $GLOBALS['plugin']->getValue('value') . "' WHERE id=" . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);
// save language specific changes
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('taxes_details') . "
           WHERE id=" . $GLOBALS['plugin']->getValue('id') . " AND lang='" . $GLOBALS['plugin']->getValue('save_lang') . "'",__FILE__,__LINE__,0);
XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('taxes_details') . " (id, lang, description) VALUES (
     " . $GLOBALS['plugin']->getValue('id') . ",
     '" . $GLOBALS['plugin']->getValue('save_lang') . "',
     '" . $GLOBALS['plugin']->getValue('description') . "'
     )"
     ,__FILE__,__LINE__);
XT::log("Taxes " . $GLOBALS['plugin']->getValue('standard') . " changed by user " . XT::getUsername(),__FILE__,__LINE__,XT_INFO);

$GLOBALS['plugin']->setAdminModule('tae');
$GLOBALS['preplugin_content'] .= "<script language=\"javascript\"><!--
yoffset = window.parent.frames['master'].pageYOffset;
window.parent.frames['master'].document.forms[1].x" . $GLOBALS['plugin']->getBaseId() . "_yoffset.value=yoffset
window.parent.frames['master'].document.forms[1].submit();
//-->
</script>";

?>
