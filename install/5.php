<?php

include_once(INCLUDE_DIR . 'compatibility.inc.php');

// Write config file
$file = file_get_contents(INCLUDE_DIR . 'config.template.inc.php');

$file = str_replace('%DATABASE_HOST%', $_SESSION['config']['database']['host'], $file);
$file = str_replace('%DATABASE_USERNAME%', $_SESSION['config']['database']['username'], $file);
$file = str_replace('%DATABASE_PASSWORD%', $_SESSION['config']['database']['password'], $file);
$file = str_replace('%DATABASE_DATABASE%', $_SESSION['config']['database']['database'], $file);
$file = str_replace('%DATABASE_PREFIX%', $_SESSION['config']['database']['prefix'], $file);

$file = str_replace('%SYSTEM_NAME%', $_SESSION['config']['system']['name'], $file);
$file = str_replace('%SYSTEM_EMAIL%', $_SESSION['config']['system']['email'], $file);
$file = str_replace('%SYSTEM_META_TITLE%', $_SESSION['config']['system']['title'], $file);
$file = str_replace('%SYSTEM_META_DESCRIPTION%', $_SESSION['config']['system']['description'], $file);
$file = str_replace('%SYSTEM_META_KEYWORDS%', $_SESSION['config']['system']['keywords'], $file);
$file = str_replace('%SYSTEM_META_AUTHOR%', $_SESSION['config']['system']['author'], $file);
$file = str_replace('%SYSTEM_META_REVISIT_AFTER%', $_SESSION['config']['system']['revisit_after'], $file);
$file = str_replace('%SYSTEM_META_COPYRIGHT%', $_SESSION['config']['system']['copyright'], $file);
$file = str_replace('%SYSTEM_GOOGLE_ANALYTICS_KEY%', $_SESSION['config']['system']['google_analytics_key'], $file);
$file = str_replace('%SYSTEM_GOOGLE_MAP_KEY%', $_SESSION['config']['system']['google_maps_key'], $file);
$file = str_replace('%SYSTEM_PIWIK_ID%', $_SESSION['config']['system']['piwik_id'], $file);
$file = str_replace('"%SYSTEM_ORDER_NR%"', $_SESSION['config']['system']['order_nr'], $file);
$file = str_replace('%WEBROOT_DIR%', $_SESSION['config']['system']['webroot_dir'], $file);
$file = str_replace('%SMTP_HOST%', $_SESSION['config']['smtp']['Host'], $file);

$file = str_replace('"%SYSTEM_TPL%"'          , 10000, $file);
$file = str_replace('"%SYSTEM_TPL_LOGIN%"'    , 99, $file);
$file = str_replace('"%SYSTEM_TRACKING_MODE%"', 0, $file);
$file = str_replace('%SYSTEM_THEME%', "default", $file);


file_put_contents(getcwd() . '/xt/includes/config.inc.php',$file);

include(getcwd() . '/xt/includes/config.inc.php');
include_once(INCLUDE_DIR . 'db.inc.php');
include_once(CLASS_DIR . 'logger.class.php');
include_once(CLASS_DIR . 'plugin.class.php');
global $logger;
$GLOBALS['logger'] = new XT_Logger();
global $plugin;
$GLOBALS['plugin'] = new XT_Plugin(1);
include_once(CLASS_DIR . 'xt.class.php');
include_once(CLASS_DIR . 'install.class.php');

$install = new XT_Install();
$install->prepareFileLocal('ch.iframe.snode.core.xtp');
$install->prepareFileLocal('ch.iframe.snode.navigation.xtp');
$install->prepareFileLocal('ch.iframe.snode.search.xtp');
$install->prepareFileLocal('ch.iframe.snode.usermanager.xtp');
$install->prepareFileLocal('ch.iframe.snode.installer.xtp');
foreach($_POST['package'] as $key => $value){
    if($key != 'ch.iframe.snode.core.xtp' && $key != 'ch.iframe.snode.navigation.xtp' && $key != 'ch.iframe.snode.search.xtp' && $key != 'ch.iframe.snode.usermanager.xtp' && $key != 'ch.iframe.snode.installer.xtp'){
        $install->prepareFileLocal($key);
    }
}

$tpl->assign('REQUIREMENTS', $_SESSION['installer']['requirements']);

$tpl->display('5.tpl');

?>