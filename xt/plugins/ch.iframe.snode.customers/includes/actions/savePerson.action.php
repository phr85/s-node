<?php

$GLOBALS['plugin']->setAdminModule('ep');

XT::query("
    UPDATE 
        " . $GLOBALS['plugin']->getTable('customers_persons') . "
    SET
        cnr = '" . $GLOBALS['plugin']->getValue("cnr") . "',
        firstName = '" . $GLOBALS['plugin']->getValue("firstName") . "',
        lastName = '" . $GLOBALS['plugin']->getValue("lastName") . "',
        customer_id = '" . $GLOBALS['plugin']->getValue("customer_id") . "',
        email = '" . $GLOBALS['plugin']->getValue("email") . "',
        position = '" . $GLOBALS['plugin']->getValue("position") . "',
        city = '" . $GLOBALS['plugin']->getValue("city") . "',
        cityCode = '" . $GLOBALS['plugin']->getValue("cityCode") . "',
        street = '" . $GLOBALS['plugin']->getValue("street") . "',
        street_nr = '" . $GLOBALS['plugin']->getValue("street_nr") . "',
        user_id = '" . $GLOBALS['plugin']->getValue("user_id") . "',
        tel = '" . $GLOBALS['plugin']->getValue("tel") . "',
        comment = '" . $GLOBALS['plugin']->getValue("comment") . "',
        gender = '" . $GLOBALS['plugin']->getValue("gender") . "',
        country = '" . $GLOBALS['plugin']->getValue("country") . "'
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue("person_id") . "
    ",__FILE__,__LINE__);

?>
