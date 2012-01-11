<?php

if(XT::getPermission("list")){
    // Enable page navigator
    XT::enableAdminCharFilter('standard');
    XT::enableAdminNavigator('units', 'id' );
    XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
    XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

    $result = XT::query("
        SELECT
            u.id,
            u.standard,
            ud.short,
            ud.full
        FROM
            " . $GLOBALS['plugin']->getTable('units') . " as u
        LEFT JOIN
            " . $GLOBALS['plugin']->getTable('units_det') . " as ud ON (u.id = ud.id AND ud.lang='" . $GLOBALS['plugin']->getActiveLang() . "')
        " . $GLOBALS['plugin']->getCharFilter() . "
        ORDER BY
            u.standard ASC
        LIMIT
            " . $GLOBALS['plugin']->getLimiter() . "
        ",__FILE__,__LINE__);

    XT::assign("DATA", XT::getQueryData($result));

    // Fetch content
    $content = XT::build("overview.tpl");
}else{
    XT::log("No Permission (BaseID:" . $GLOBALS['plugin']->getBaseID() . ")" ,__FILE__,__LINE__,XT_ERROR);
    $content = "";
}

?>
