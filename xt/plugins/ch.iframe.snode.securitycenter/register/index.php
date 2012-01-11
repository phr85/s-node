<?php

if ( XT::getValue('pseudoaction') == "register"){

    $condition = true;
    eval(XT::getConfig('condition'));
    if ($condition == true) {
        XT::call("register");
    } else {
        XT::actionStop("Condition failed");
    }
}

// Parameter :: Style
$style = $GLOBALS['plugin']->getParam('style') != '' ? $GLOBALS['plugin']->getParam('style') : 'default.tpl';

// assign other data
$assign['email'] = XT::getValue('email');
$assign['username'] = XT::getValue('username');

if(XT::getValue('password')!=""){
    $assign['password'] = XT::getValue('password');
}
if(XT::getValue('password_repeat')!=""){
    $assign['password_repeat'] = XT::getValue('password_repeat');
}

$assign['ERRORS'] = XT::getActionStopped();
XT::assign("xt" . XT::getBaseID() . "_register", $assign);


$content = XT::build($style);
?>