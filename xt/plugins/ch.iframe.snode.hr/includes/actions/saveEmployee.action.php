<?php

XT::query("UPDATE " . $GLOBALS['plugin']->getTable("employees") . "
    SET
        lastName = '" . $GLOBALS['plugin']->getValue("lastName") . "',
        firstName = '" . $GLOBALS['plugin']->getValue("firstName") . "',
        user_id = '" . $GLOBALS['plugin']->getValue("user_id") . "',
        image = '" . $GLOBALS['plugin']->getValue("image") . "',
        image_version = '" . $GLOBALS['plugin']->getValue("image_version") . "',
        email = '" . $GLOBALS['plugin']->getValue("email") . "',
        tel = '" . $GLOBALS['plugin']->getValue("tel") . "',
        street = '" . $GLOBALS['plugin']->getValue("street") . "',
        street_nr = '" . $GLOBALS['plugin']->getValue("street_nr") . "',
        cityCode = '" . $GLOBALS['plugin']->getValue("cityCode") . "',
        city = '" . $GLOBALS['plugin']->getValue("city") . "',
        social_nr = '" . $GLOBALS['plugin']->getValue("social_nr") . "'
    WHERE
        id = '" . $GLOBALS['plugin']->getSessionValue("id") . "'
",__FILE__,__LINE__);

$GLOBALS['plugin']->setAdminModule("e");

?>
