<?php
// Add user to role
$GLOBALS['plugin']->setAdminModule('e');

$user_id = -1;
$result = XT::query("SELECT id FROM " . $GLOBALS['plugin']->getTable("user") . " WHERE username = '" . $GLOBALS['plugin']->getValue("username") . "'",__FILE__,__LINE__);
while($row = $result->FetchRow()){
    $user_id = $row['id'];
}

if($user_id >= 0){
    // insert and don't show error
    @XT::query("
        INSERT INTO " . $GLOBALS['plugin']->getTable('user_roles') . " (
            user_id,
            role_id
        ) VALUES (
            " . $user_id . ",
            " . $GLOBALS['plugin']->getSessionValue("id") . "
        )",__FILE__,__LINE__);
} else {
    XT::log("User doesn't exist.",__FILE__,__LINE__,XT_ERROR);
}
?>
