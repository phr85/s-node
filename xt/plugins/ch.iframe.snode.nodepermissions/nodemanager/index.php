<?php

XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

// Get mode
$mode = "user";
if($GLOBALS['plugin']->getSessionValue("mode") != ''){
    $mode = $GLOBALS['plugin']->getSessionValue("mode");
}
if($GLOBALS['plugin']->getValue("mode") != ''){
    $mode = $GLOBALS['plugin']->getValue("mode");
}
$GLOBALS['plugin']->setSessionValue("mode",$mode);

// Get permissions
if($GLOBALS['plugin']->getValue("package") != ''){
    $GLOBALS['plugin']->setSessionValue("package",$GLOBALS['plugin']->getValue("package"));
}

$permissions = glob(PLUGIN_DIR . $GLOBALS['plugin']->getSessionValue("package") . "/includes/permissions/*.permission.php");
if(is_array($permissions)){
    foreach($permissions as $key => $value){
        $file = basename($value);
        $file_parts = explode('.',$file);
        $perms[$file_parts[0]]['perm'] = $file_parts[1];
    }
}

// Get information about choosed principal
if(is_numeric($GLOBALS['plugin']->getValue("group_id"))){

    $result = XT::query("
        SELECT
            perms
        FROM
            " . $GLOBALS['cfg']->get("database","prefix") . "node_perms
        WHERE
            base_id = " . $GLOBALS['plugin']->getValue("base_id") . "
            AND lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
            AND principal_id = " . $GLOBALS['plugin']->getValue("group_id") . "
            AND node_id = " . $GLOBALS['plugin']->getValue("node_id") . "
            AND principal_type = 2
        ",__FILE__,__LINE__);

}
if(is_numeric($GLOBALS['plugin']->getValue("role_id"))){

    $result = XT::query("
        SELECT
            perms
        FROM
            " . $GLOBALS['cfg']->get("database","prefix") . "node_perms
        WHERE
            base_id = " . $GLOBALS['plugin']->getValue("base_id") . "
            AND lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
            AND principal_id = " . $GLOBALS['plugin']->getValue("role_id") . "
            AND node_id = " . $GLOBALS['plugin']->getValue("node_id") . "
            AND principal_type = 3
        ",__FILE__,__LINE__);
}
if(is_numeric($GLOBALS['plugin']->getValue("user_id"))){

    $result = XT::query("
        SELECT
            perms
        FROM
            " . $GLOBALS['cfg']->get("database","prefix") . "node_perms
        WHERE
            base_id = " . $GLOBALS['plugin']->getValue("base_id") . "
            AND lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
            AND principal_id = " . $GLOBALS['plugin']->getValue("user_id") . "
            AND node_id = " . $GLOBALS['plugin']->getValue("node_id") . "
            AND principal_type = 1
        ",__FILE__,__LINE__);
}

if($result){
    $data = array();
    while($row = $result->FetchRow()){
        foreach($perms as $key => $value){
            $perms[$key]['rights'] = $GLOBALS['perm']->getPerm($row['perms'],$key);
        }
    }
    XT::assign("ACTIVE_PRINCIPAL", $GLOBALS['plugin']->getValue($GLOBALS['plugin']->getValue("mode") . "_id"));
}

// Assign permissions
XT::assign("PERMS", $perms);

// Get groups, roles or users
switch($GLOBALS['plugin']->getSessionValue("mode")){
    case 'group':

        // Set filter
        $filter = "";
        if($GLOBALS['plugin']->getValue("filter") != ''){
            $filter = "WHERE title LIKE '" . $GLOBALS['plugin']->getValue("filter") . "%'";
        }

        // Enable navigator
        XT::enableAdminNavigator('','',"
            SELECT
                count(id)
            FROM
                " . $GLOBALS['cfg']->get("database","prefix") . "groups
            " . $filter . "
        ");

        // Get groups
        $result = XT::query("
            SELECT
                id,
                title
            FROM
                " . $GLOBALS['cfg']->get("database","prefix") . "groups
            " . $filter . "
            ORDER BY
                title ASC
            LIMIT " . XT::getAdminNavigatorLimit() . "
            ",__FILE__,__LINE__);

        XT::assign("PRINCIPALS", XT::getQueryData($result));
        break;

    case 'role':
        // Set filter
        $filter = "";
        if($GLOBALS['plugin']->getValue("filter") != ''){
            $filter = "WHERE title LIKE '" . $GLOBALS['plugin']->getValue("filter") . "%'";
        }

        // Enable navigator
        XT::enableAdminNavigator('','',"
            SELECT
                count(id)
            FROM
                " . $GLOBALS['cfg']->get("database","prefix") . "roles
            " . $filter . "
        ");

        // Get roles
        $result = XT::query("
            SELECT
                id,
                title
            FROM
                " . $GLOBALS['cfg']->get("database","prefix") . "roles
            " . $filter . "
            ORDER BY
                title ASC
            LIMIT " . XT::getAdminNavigatorLimit() . "
            ",__FILE__,__LINE__);

        XT::assign("PRINCIPALS", XT::getQueryData($result));
        break;

    default:

        // Set filter
        $filter = "";
        if($GLOBALS['plugin']->getValue("filter") != ''){
            $filter = "WHERE username LIKE '" . $GLOBALS['plugin']->getValue("filter") . "%'";
        }

        // Enable navigator
        XT::enableAdminNavigator('','',"
            SELECT
                count(id)
            FROM
                " . $GLOBALS['cfg']->get("database","prefix") . "user
            " . $filter . "
        ");

        // Get users
        $result = XT::query("
            SELECT
                id,
                username as title
            FROM
                " . $GLOBALS['cfg']->get("database","prefix") . "user
            " . $filter . "
            ORDER BY
                username ASC
            LIMIT " . XT::getAdminNavigatorLimit() . "
            ",__FILE__,__LINE__);

        XT::assign("PRINCIPALS", XT::getQueryData($result));
        break;
}

XT::assign("ACTIVE_MODE", $GLOBALS['plugin']->getSessionValue("mode"));
XT::assign("NODE_ID", $GLOBALS['plugin']->getValue("node_id"));
XT::assign("ACTIVE_BASEID", $GLOBALS['plugin']->getValue("base_id"));
XT::assign("ACTIVE_FILTER", $GLOBALS['plugin']->getValue("filter"));

$content = XT::build("popup.tpl");

?>
