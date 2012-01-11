<?php
XT::query("UPDATE
               " . $GLOBALS['plugin']->getTable('fieldnames') . "
           SET
               fieldname= '" . $GLOBALS['plugin']->getValue('fieldname') . "',
               position= '" . $GLOBALS['plugin']->getValue('position') . "',
               description= '". $GLOBALS['plugin']->getValue('description')."'
           WHERE
               id=" . $GLOBALS['plugin']->getSessionValue('property_id') . "
           AND
               lang='" . $GLOBALS['plugin']->getValue('save_lang') . "'"
          ,__FILE__,__LINE__);
$GLOBALS['plugin']->setAdminModule('pe');
echo "<script language=\"javascript\"><!--
yoffset = window.parent.frames['master'].pageYOffset;
window.parent.frames['master'].document.forms[1].x" . $GLOBALS['plugin']->getBaseId() . "_yoffset.value=yoffset
window.parent.frames['master'].document.forms[1].submit();
//-->
</script>";
?>
