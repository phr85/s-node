<?php

/**
 * addUserConfirm
 *
 * @package S-Node
 * @subpackage Usermanager
 * @author Roger Dudler <rdudler@iframe.ch>
 * @copyright Copyright 2005, iframe AG, http://www.iframe.ch
 * @version $Id: addUserConfirm.action.php 1066 2005-07-19 13:27:58Z vzaech $
 */

/**
 * Adds a user
 */
$GLOBALS['plugin']->setAdminModule('a');

$password = "";
if(($GLOBALS['plugin']->getPostValue('password') != $GLOBALS['plugin']->getPostValue('password_confirm'))){
    XT::log("Your passwords are not identical",__FILE__,__LINE__,XT_ERROR);
} else {
    if($GLOBALS['plugin']->getPostValue('password') != '' && $GLOBALS['plugin']->getPostValue('password_confirm') != ''){
        $password = md5($GLOBALS['plugin']->getPostValue('password') . $GLOBALS['cfg']->get("system","magic"));
    }
}
if($GLOBALS['plugin']->getPostValue('password') == ""){
    XT::log("Password cannot be empty",__FILE__,__LINE__,XT_ERROR);
}

if($GLOBALS['plugin']->getPostValue('username') == ""){
    XT::log("Username cannot be empty",__FILE__,__LINE__,XT_ERROR);
}

if($GLOBALS['plugin']->getPostValue('email') == ""){
    XT::log("E-Mail address cannot be empty",__FILE__,__LINE__,XT_ERROR);
}

// Check for already existing username
$result = XT::query("SELECT id FROM " . $GLOBALS['plugin']->getTable('user') . " WHERE username = '" . $GLOBALS['plugin']->getPostValue('username') . "'",__FILE__,__LINE__);
while($row = $result->FetchRow()){
    XT::log("This username is already in use",__FILE__,__LINE__,XT_ERROR);
}

// If there were no errors, go ahead an insert user into db
if(!XT::hasErrors()){

    XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('user') . " (
        username,
        password,
        email,
        creation_date,
        creation_user,
        mod_date,
        mod_user
        ) VALUES (
        '" . $GLOBALS['plugin']->getPostValue('username') . "',
        '" . $password . "',
        '" . $GLOBALS['plugin']->getPostValue('email') . "',
        " . time() . ",
        " . $_SESSION['user']['id'] . ",
        " . time() . ",
        " . $_SESSION['user']['id'] . "
        )",__FILE__,__LINE__);

    $GLOBALS['plugin']->setAdminModule('o');
}

?>