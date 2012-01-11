<?php

// Include currencies
include_once(INCLUDE_DIR . "currencies.inc.php");

// Get SOAP configuration
$config = $GLOBALS['plugin']->getConfig('soap_options');

// Connect to SOAP server
global $soapclient;
$soapclient = new SoapClient(null, $config);

global $refPlugin;
$refPlugin = $GLOBALS['plugin'];

// Authenticate soap client
function auth() {

    // Generate salt
    $salt = $GLOBALS['soapclient']->authUser($GLOBALS['refPlugin']->getConfig('soap_username'), $GLOBALS['refPlugin']->getConfig('soap_password'));

    // Check for correct salt
    checkSOAP($salt);

    // Save access key
    $GLOBALS['refPlugin']->setSessionValue('soap_accesskey', md5($GLOBALS['refPlugin']->getConfig('soap_username') . $GLOBALS['refPlugin']->getConfig('soap_password') . $salt));

}

// Check for an access key
if($GLOBALS['plugin']->getSessionValue('soap_accesskey') == '') {
        auth($GLOBALS['plugin'], $soapclient);
}

if($GLOBALS['plugin']->getValue('id') == '') {
    // Get all packages
    $packages = $soapclient->getPackages($GLOBALS['plugin']->getSessionValue('soap_accesskey'));
    checkSOAP($packages);

    if(is_array($packages)) {
        XT::assign('PACKAGES', $packages);
        XT::assign('CURRENCIES', $GLOBALS['currencies']);
        $content = XT::build('repository.tpl');
    }
}
else {
    $GLOBALS['plugin']->addButton('Packages', 'showRepository');
    XT::assign("BUTTONS", $GLOBALS['plugin']->getButtons());
    // Get all modules
    $modules= $soapclient->getModules($GLOBALS['plugin']->getSessionValue('soap_accesskey'), $GLOBALS['plugin']->getValue('id'));
    checkSOAP($modules);

    if(is_array($modules)) {
        XT::assign('MODULES', $modules);
        $content = XT::build('repository_modules.tpl');
    }
}

// Function to check results
function checkSOAP($result) {
    switch($result) {
        case SOAP_AUTH_DISABLED:
            XT::log("Authentification for this user is disabled",__FILE__,__LINE__,XT_ERROR);
            break;

        case SOAP_AUTH_ERROR:
            XT::log("Authentification error on remote system",__FILE__,__LINE__,XT_ERROR);
            break;

        case SOAP_AUTH_FAILED:
            XT::log("Authentification failed",__FILE__,__LINE__,XT_ERROR);
            break;

        case SOAP_CONNECTION_TIMEOUT:
            XT::log("Connection timeout", __FILE__,__LINE__,XT_NOTICE);
            $GLOBALS['refPlugin']->setSessionValue('soap_accesskey', '');
            auth();
            break;

        case SOAP_ACCESS_DENIED:
            $GLOBALS['refPlugin']->setSessionValue('soap_accesskey', '');
            auth();
            break;
    }
}

// Check for an access key
if($GLOBALS['plugin']->getSessionValue('soap_accesskey') == '') {
        auth($GLOBALS['plugin'], $soapclient);
}

if($GLOBALS['plugin']->getValue('id') == '') {
    // Get all packages
    $packages = $soapclient->getPackages($GLOBALS['plugin']->getSessionValue('soap_accesskey'));
    checkSOAP($packages);

    if(is_array($packages)) {
        $GLOBALS['tpl']->assign('PACKAGES', $packages);
        $content = $GLOBALS['tpl']->fetch($GLOBALS['plugin']->tpl_location . 'repository.tpl');
    }
}
else {
    $GLOBALS['plugin']->addButton('Packages', 'SOAP_showRepository');
    $GLOBALS['tpl']->assign("BUTTONS", $GLOBALS['plugin']->getButtons());
    // Get all modules
    $modules= $soapclient->getModules($GLOBALS['plugin']->getSessionValue('soap_accesskey'), $GLOBALS['plugin']->getValue('id'));
    checkSOAP($modules);

    if(is_array($modules)) {
        $GLOBALS['tpl']->assign('MODULES', $modules);
        $content = $GLOBALS['tpl']->fetch($GLOBALS['plugin']->tpl_location . 'repository_modules.tpl');
    }
}
?>