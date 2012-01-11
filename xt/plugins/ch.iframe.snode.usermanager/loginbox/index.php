<?php

// Parameter :: Style
$style = $GLOBALS['plugin']->getParam('style') != '' ? XT::getParam('style') : 'default.tpl';

// Parameter :: Loggedin Style
$logedin_style = $GLOBALS['plugin']->getParam('logedin_style') != '' ? XT::getParam('logedin_style') : 'loggedin.tpl';

// Parameter :: redirect_tpl
$redirect_tpl = $GLOBALS['plugin']->getParam('redirect_tpl') != '' ? XT::getParam('redirect_tpl') : false;

if(!XT::isLoggedIn()){

    $_SESSION['requested_url'] = $GLOBALS['plugin']->getParam('target') != '' ? $GLOBALS['plugin']->getParam('target') : $GLOBALS['plugin']->getValue('url');

    XT::assign("FIELD_USERNAME", $GLOBALS['auth']->getUsernameField());
    XT::assign("FIELD_PASSWORD", $GLOBALS['auth']->getPasswordField());

    if(isset($_POST['username']) || isset($_POST['password'])){
        XT::assign("ERROR_MSG", "username or passwort incorrect");
    }

    XT::assign("LOST_TPL", $GLOBALS['plugin']->getConfig('lost_tpl'));

    // Get Plugin Content
    $content = XT::build($style);

} else {
    
    // Redirect
    if($redirect_tpl) {
        header("Location: http://{$_SERVER["SERVER_NAME"]}/index.php?TPL={$redirect_tpl}");
    }

    // Get Plugin Content
    $content = XT::build($logedin_style);

}

?>