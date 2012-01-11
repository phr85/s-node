<?PHP
// Set filter
if($GLOBALS['plugin']->getValue("filter") != ''){
    $filter = "WHERE username LIKE '" . $GLOBALS['plugin']->getValue("filter") . "%'";
}

// Enable navigator
XT::enableAdminNavigator('','',"
            SELECT
                count(id) as count_id
            FROM
                " . $GLOBALS['cfg']->get("database","prefix") . "user
            " . $filter . "
        ");

// Get users
$result = XT::query("
            SELECT
                id,
                username
            FROM
                " . $GLOBALS['cfg']->get("database","prefix") . "user
            " . $filter . "
            ORDER BY
                username ASC
            LIMIT " . XT::getAdminNavigatorLimit() . "
            ",__FILE__,__LINE__);

XT::assign("DATA", XT::getQueryData($result));
XT::assign("ACTIVE_FILTER", $GLOBALS['plugin']->getValue("filter"));
XT::assign("USER_ID",$GLOBALS['plugin']->getValue('user_id'));
// Fetch content
if($GLOBALS['plugin']->getParam("style") != ""){
    $style = $GLOBALS['plugin']->getParam("style");
}else{
    $style = "mUser.tpl";
}
$content = XT::build($style);
?>