<?php
$GLOBALS['plugin']->setAdminModule('e');

$password = "";
if(($GLOBALS['plugin']->getPostValue('password') != $GLOBALS['plugin']->getPostValue('password_confirm'))){
    XT::log("Your passwords are not identical.",__FILE__,__LINE__,XT_ERROR);
} else {
    if($GLOBALS['plugin']->getPostValue('password') != '' && $GLOBALS['plugin']->getPostValue('password_confirm') != ''){
        $password = " password = '" . md5($GLOBALS['plugin']->getPostValue('password') . $GLOBALS['cfg']->get("system","magic")) . "',";
    }
}

if(!XT::hasErrors()){
    XT::query("UPDATE " . $GLOBALS['plugin']->getTable('user') . " SET
        " . $password . "
        email = '" . $GLOBALS['plugin']->getPostValue('email') . "'
        , lang = '" . $GLOBALS['plugin']->getPostValue('language') . "'
        , date_short = '" . $GLOBALS['plugin']->getPostValue('date_short') . "'
        , date_long = '" . $GLOBALS['plugin']->getPostValue('date_long') . "'
        , firstName = '" . $GLOBALS['plugin']->getPostValue('firstName') . "'
        , lastName = '" . $GLOBALS['plugin']->getPostValue('lastName') . "'
        , street = '" . $GLOBALS['plugin']->getPostValue('street') . "'
        , plz = '" . $GLOBALS['plugin']->getPostValue('plz') . "'
        , city = '" . $GLOBALS['plugin']->getPostValue('city') . "'
        , tel = '" . $GLOBALS['plugin']->getPostValue('tel') . "'
        , facsimile = '" . $GLOBALS['plugin']->getPostValue('facsimile') . "'
        , description = '" . $GLOBALS['plugin']->getPostValue('description') . "'
        , image = '" . $GLOBALS['plugin']->getPostValue('image') . "'
        , image_version = '" . $GLOBALS['plugin']->getPostValue('image_version') . "'
        WHERE id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);

    XT::log("Your changes for user \"" . $GLOBALS['plugin']->getPostValue('username') . "\" were successfully saved.",__FILE__,__LINE__,XT_INFO);
    
    require_once(CLASS_DIR . "searchindex.class.php");
    $search = new XT_SearchIndex($GLOBALS['plugin']->getValue('id'),$GLOBALS['plugin']->getContentType("User"));
    $search->add($GLOBALS['plugin']->getValue("firstName"), 1);
    $search->add($GLOBALS['plugin']->getValue("lastName"), 2);
    $search->build($GLOBALS['plugin']->getValue("username"), $GLOBALS['plugin']->getValue("description"));
    
}

?>