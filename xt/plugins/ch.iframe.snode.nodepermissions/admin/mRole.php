<?PHP
// Set filter
if($GLOBALS['plugin']->getValue("filter") != ''){
    $filter = "WHERE title LIKE '" . $GLOBALS['plugin']->getValue("filter") . "%'";
}

// Enable navigator
XT::enableAdminNavigator('','',"
            SELECT
                count(id) as count_id
            FROM
                " . $GLOBALS['cfg']->get("database","prefix") . "roles
            " . $filter . "
        ");

// Get roles
$result = XT::query("
            SELECT
                id,
                title,
                description
            FROM
                " . $GLOBALS['cfg']->get("database","prefix") . "roles
            " . $filter . "
            ORDER BY
                title ASC
            LIMIT " . XT::getAdminNavigatorLimit() . "
            ",__FILE__,__LINE__);


XT::assign("DATA", XT::getQueryData($result));
XT::assign("ACTIVE_FILTER", $GLOBALS['plugin']->getValue("filter"));
XT::assign("ROLE_ID",$GLOBALS['plugin']->getValue('role_id'));
// Fetch content
if($GLOBALS['plugin']->getParam("style") != ""){
    $style = $GLOBALS['plugin']->getParam("style");
}else{
    $style = "mRole.tpl";
}
$content = XT::build($style);
?>