<?php
$password = "";
if(($GLOBALS['plugin']->getPostValue('password') != $GLOBALS['plugin']->getPostValue('password_confirm'))){
    XT::log("Your passwords are not identical.",__FILE__,__LINE__,XT_ERROR);
} else {
    if($GLOBALS['plugin']->getPostValue('password') != '' && $GLOBALS['plugin']->getPostValue('password_confirm') != ''){
        $password = " password = '" . md5($GLOBALS['plugin']->getPostValue('password') . $GLOBALS['cfg']->get("system","magic")) . "',";
    }
}

if(!XT::hasErrors()){
    XT::query("UPDATE " . $GLOBALS['plugin']->getTable('users') . " SET
        " . $password . "
        email = '" . $GLOBALS['plugin']->getPostValue('email') . "'
        , lang = '" . $GLOBALS['plugin']->getPostValue('language') . "'
        , description = '" . $GLOBALS['plugin']->getPostValue('description') . "'
        , image = '" . $GLOBALS['plugin']->getPostValue('image') . "'
        WHERE id = " . $GLOBALS['plugin']->getValue('user_id')
    ,__FILE__,__LINE__);


// Update email bei der addresse
XT::loadClass('address.class.php','ch.iframe.snode.addressmanager');
$address = new XT_Address(XT::getValue('address_id'));
$oldmail = $address->getEMail();
$address->setEMail(XT::getValue("email"));
$address->setImage(XT::getValue("image"));
$address->save();

if(is_file(LICENCES_DIR . $GLOBALS["cfg"]->get("system","order_nr") . "_ch.iframe.snode.newsletter.zl") && $oldmail != '') {
    // Update email beim newsletter
    XT::query("UPDATE " . XT::getTable('newsletter_subscriptions') . " SET
        email = '" . XT::getValue("email") . "'
        WHERE email = '" . $oldmail . "'
    ",__FILE__,__LINE__);
}

    XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
    $search = new XT_SearchIndex($GLOBALS['plugin']->getValue('user_id'),$GLOBALS['plugin']->getContentType("User"));
    $search->add($GLOBALS['plugin']->getValue("firstName"), 1);
    $search->add($GLOBALS['plugin']->getValue("lastName"), 2);
    $search->build($GLOBALS['plugin']->getValue("username"), $GLOBALS['plugin']->getValue("description"));

}

?>