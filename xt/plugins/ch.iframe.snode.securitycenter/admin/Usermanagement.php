<?PHP

if(XT::getPermission('user')){

    // Enable Char filter and navigator
    XT::enableAdminCharFilter('username');
    XT::enableAdminNavigator('users');

    // Get users list
    $result = XT::query("
        SELECT
            usr.id,
            usr.username,
            address.lastName,
            address.firstName,
            usr.last_login_date,
            usr.active
        FROM
            " . XT::getTable('users') . " as usr
        LEFT JOIN
            " . XT::getTable('addresses') . " as address ON usr.id=address.user_id AND address.is_primary_user_address=1
            " . XT::getAdminCharFilter() . "
        GROUP by usr.id
        ORDER BY
            username ASC
        LIMIT
            " . XT::getAdminNavigatorLimit() . "
        ",__FILE__,__LINE__);

    XT::assign("DATA", XT::getQueryData($result));

XT::addImageButton("create <u>u</u>ser", "createUser" ,"default","user1.png","0","slave1","u");
$content = XT::build('Usermanagement.tpl');
}else{
    XT::log("No Permission (BaseID:" . $GLOBALS['plugin']->getBaseID() . ")" ,__FILE__,__LINE__,XT_ERROR);
    $content = "";
}