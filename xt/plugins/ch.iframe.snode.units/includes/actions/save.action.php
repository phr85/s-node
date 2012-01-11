<?php
$GLOBALS['plugin']->setAdminModule('e');

// save standard
XT::query("UPDATE " . $GLOBALS['plugin']->getTable('units') . " SET standard= '" . $GLOBALS['plugin']->getValue('standard') . "' WHERE id=" . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);
// save language specific changes
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('units_det') . "
           WHERE id=" . $GLOBALS['plugin']->getValue('id') . " AND lang='" . $GLOBALS['plugin']->getValue('save_lang') . "'",__FILE__,__LINE__,0);
XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('units_det') . " (id, lang, short, full) VALUES (
     " . $GLOBALS['plugin']->getValue('id') . ",
     '" . $GLOBALS['plugin']->getValue('save_lang') . "',
     '" . $GLOBALS['plugin']->getValue('short') . "',
     '" . $GLOBALS['plugin']->getValue('full') . "')"
     ,__FILE__,__LINE__);
XT::log("Unit " . $GLOBALS['plugin']->getValue('standard') . " changed by user " . XT::getUsername(),__FILE__,__LINE__,XT_INFO);
$GLOBALS['preplugin_content'] .= "<script language=\"javascript\"><!--
yoffset = window.parent.frames['master'].pageYOffset;
window.parent.frames['master'].document.forms[1].x" . $GLOBALS['plugin']->getBaseId() . "_yoffset.value=yoffset
window.parent.frames['master'].document.forms[1].submit();
//-->
</script>";
?>
