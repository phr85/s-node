<?php

$GLOBALS['plugin']->setAdminModule('ec');

XT::query("
    UPDATE 
        " . $GLOBALS['plugin']->getTable('customers') . "
    SET
        title = '" . $GLOBALS['plugin']->getValue("title") . "',
        cnr = '" . $GLOBALS['plugin']->getValue("cnr") . "',
        postalCode = '" . $GLOBALS['plugin']->getValue("postalCode") . "',
        city = '" . $GLOBALS['plugin']->getValue("city") . "',
        po_box = '" . $GLOBALS['plugin']->getValue("po_box") . "',
        street = '" . $GLOBALS['plugin']->getValue("street") . "',
        street_nr = '" . $GLOBALS['plugin']->getValue("street_nr") . "',
        tel = '" . $GLOBALS['plugin']->getValue("tel") . "',
        facsimile = '" . $GLOBALS['plugin']->getValue("facsimile") . "',
        mod_date = " . time() . ",
        mod_user = " . XT::getUserID() . ",
        country = '" . $GLOBALS['plugin']->getValue("country") . "',
        our_consultant = '" . $GLOBALS['plugin']->getValue("our_consultant") . "',
        our_technician = '" . $GLOBALS['plugin']->getValue("our_technician") . "'
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue("customer_id") . "
    ",__FILE__,__LINE__);

?>
