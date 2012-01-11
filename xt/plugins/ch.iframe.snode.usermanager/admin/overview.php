<?php

function_exists("zend_loader_file_licensed") ? XT::checkDomain(zend_loader_file_licensed()) : null;

/*
require_once(CLASS_DIR . "ldap.class.php");
$ldap = new XT_LDAP();
$ldap->connect("10.1.1.25");
$ldap->bind("cn=admin,dc=test,dc=iframe,dc=ch","3297dude");

echo "<pre>";
print_r($ldap->search("sn=Dudler"));
echo "</pre>";

$ldap->close();
*/

if(XT::getPermission('list')){

    // Enable Char filter and navigator
    XT::enableAdminCharFilter('username');
    XT::enableAdminNavigator('user');

    // Get users list
    $result = XT::query("
        SELECT
            id,
            username,
            lastName,
            firstName,
            last_login_date,
            active
        FROM
            " . XT::getTable('user') . XT::getAdminCharFilter() . "
        ORDER BY
            username ASC
        LIMIT
            " . XT::getAdminNavigatorLimit() . "
        ",__FILE__,__LINE__);

    XT::assign("DATA", XT::getQueryData($result));

    // Build plugin
    $content = XT::build('overview.tpl');

}else{
    XT::log("No Permission (BaseID:" . $GLOBALS['plugin']->getBaseID() . ")" ,__FILE__,__LINE__,XT_ERROR);
    $content = "";
}

?>
