<?php

// save standard
XT::query("UPDATE " . $GLOBALS['plugin']->getTable('discounts') . "
           SET
               value= '" . $GLOBALS['plugin']->getValue('value') . "',
               give_discount_at ='" . $GLOBALS['plugin']->getValue('give_discount_at') . "',
               in_percent =" . $GLOBALS['plugin']->getValue('in_percent') . "

           WHERE
               id=" . $GLOBALS['plugin']->getValue('id')
               ,__FILE__,__LINE__);
// save language specific changes
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('discounts_details') . "
           WHERE id=" . $GLOBALS['plugin']->getValue('id') . " AND lang='" . $GLOBALS['plugin']->getValue('save_lang') . "'",__FILE__,__LINE__,0);
XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('discounts_details') . " (id, lang, name, description) VALUES (
     " . $GLOBALS['plugin']->getValue('id') . ",
     '" . $GLOBALS['plugin']->getValue('save_lang') . "',
     '" . $GLOBALS['plugin']->getValue('name') . "',
     '" . $GLOBALS['plugin']->getValue('description') . "'
     )"
     ,__FILE__,__LINE__);
XT::log("Discounts " . $GLOBALS['plugin']->getValue('standard') . " changed by user " . XT::getUsername(),__FILE__,__LINE__,XT_INFO);

$GLOBALS['plugin']->setAdminModule('de');
$GLOBALS['preplugin_content'] .= "<script language=\"javascript\"><!--
yoffset = window.parent.frames['master'].pageYOffset;
window.parent.frames['master'].document.forms[1].x" . $GLOBALS['plugin']->getBaseId() . "_yoffset.value=yoffset
window.parent.frames['master'].document.forms[1].submit();
//-->
</script>";

?>
