<?php

XT::query("
    INSERT INTO
        " . XT::getDatabasePrefix() . "newsletter_subscriptions
    (
        creation_date,
        creation_user,
        lang
    ) VALUES (
        " . time() . ",
        " . XT::getUserID() . ",
        '" . $GLOBALS['cfg']->get('lang','default') . "'
    )
",__FILE__,__LINE__);

$result = XT::query("SELECT MAX(id) as id FROM " . XT::getDatabasePrefix() . "newsletter_subscriptions",__FILE__,__LINE__);

$row = $result->fetchRow();
XT::setValue("subscriber_id", $row['id']);
XT::setAdminModule("es");
?>