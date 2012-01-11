<?php

function_exists("zend_loader_file_licensed") ? XT::checkDomain(zend_loader_file_licensed()) : null;

if(XT::getPermission('list')){

    XT::enableAdminNavigator('guestbook');

    if(XT::getPermission('add')){
        // Buttons
        XT::addButton("Add entry", "addEntry");
    }

    // SQL
    $result = XT::query("
        SELECT
            id,
            active,
            creation_date,
            comment,
            ip,
            blockip
        FROM
            " . XT::getTable("guestbook") . "
        ORDER BY
            id DESC
        LIMIT
            " . XT::getAdminNavigatorLimit() . "
        ",__FILE__,__LINE__);

    XT::assign("DATA", XT::getQueryData($result));
    XT::assign("IPBLOCKING", $GLOBALS['plugin']->getConfig('ipblocking'));

    $content = XT::build("overview.tpl");

}

?>