<?php

if(XT::getPermission("manageProperties")){
	XT::addImageButton('Add','addPropertyGroup','default','add.png','0','slave1');
    // Enable page navigator
    XT::enableAdminCharFilter('name');
    XT::enableAdminNavigator('pgroups', 'id' );
    XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
    XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

    $result = XT::query("
        SELECT
            group_id as id,
            title,
            description
        FROM
            " . XT::getTable("pgroups_details") . "
        WHERE
            lang='" . XT::getPluginLang() . "'
             " . $GLOBALS['plugin']->getCharFilter('AND') . "
        ORDER BY
            title ASC
        LIMIT " . $GLOBALS['plugin']->getLimiter() . "
        ",__FILE__,__LINE__);

    XT::assign("DATA", XT::getQueryData($result));

    // Fetch content
    $content = XT::build("groups_overview.tpl");
}else{
    XT::log("No Permission (BaseID:" . $GLOBALS['plugin']->getBaseID() . ")" ,__FILE__,__LINE__,XT_ERROR);
    $content = "";
}

?>