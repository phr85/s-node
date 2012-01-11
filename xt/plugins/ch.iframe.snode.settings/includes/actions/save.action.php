<?php

// Write config file
$file = file_get_contents(INCLUDE_DIR . 'config.template.inc.php');

$file = str_replace('%DATABASE_HOST%', XT::getValue('database_host'), $file);
$file = str_replace('%DATABASE_USERNAME%', XT::getValue('database_username'), $file);
$file = str_replace('%DATABASE_PASSWORD%', XT::getValue('database_password'), $file);
$file = str_replace('%DATABASE_DATABASE%', XT::getValue('database_database'), $file);
$file = str_replace('%DATABASE_PREFIX%', XT::getValue('database_prefix'), $file);

$file = str_replace('%SYSTEM_NAME%', XT::getValue('system_name'), $file);
$file = str_replace('%SYSTEM_EMAIL%', XT::getValue('system_email'), $file);
$file = str_replace('%SYSTEM_META_TITLE%', XT::getValue('system_meta_title'), $file);
$file = str_replace('%SYSTEM_META_DESCRIPTION%', XT::getValue('system_meta_description'), $file);
$file = str_replace('%SYSTEM_META_KEYWORDS%', XT::getValue('system_meta_keywords'), $file);
$file = str_replace('%SYSTEM_META_AUTHOR%', XT::getValue('system_meta_author'), $file);
$file = str_replace('%SYSTEM_META_REVISIT_AFTER%', XT::getValue('system_meta_revisit_after'), $file);
$file = str_replace('%SYSTEM_META_COPYRIGHT%', XT::getValue('system_meta_copyright'), $file);
$file = str_replace('%SYSTEM_PIWIK_ID%', XT::getValue('system_piwik_id'), $file);
$file = str_replace('%SYSTEM_GOOGLE_ANALYTICS_KEY%', XT::getValue('system_google_analytics_key'), $file);
$file = str_replace('%SYSTEM_GOOGLE_MAP_KEY%', XT::getValue('system_google_map_key'), $file);

$file = str_replace('"%SYSTEM_FILE_SECURITY%"', XT::getValue('disable_file_security'), $file);

// SMTP HOST
if ($GLOBALS['cfg']->get("smtp","Host")=="%SMTP_HOST%"){
    $defaults['smtphost'] = "localhost";
}else {
	$defaults['smtphost'] = $GLOBALS['cfg']->get("smtp","Host");
}
$file = str_replace('%SMTP_HOST%', $defaults['smtphost'], $file);

$file = str_replace('%WEBROOT_DIR%'         , WEBROOT_DIR, $file);
$file = str_replace('"%SYSTEM_ORDER_NR%"'     , $GLOBALS['cfg']->get("system","order_nr"), $file);
$file = str_replace('"%SYSTEM_TPL%"'          , $GLOBALS['cfg']->get("system","tpl"), $file);
$file = str_replace('"%SYSTEM_TPL_LOGIN%"'    , $GLOBALS['cfg']->get("system","tpl_login"), $file);
$file = str_replace('"%SYSTEM_TRACKING_MODE%"', $GLOBALS['cfg']->get("system","tracking_mode"), $file);

$file = str_replace('%SYSTEM_THEME%', $GLOBALS['cfg']->get("system","theme"), $file);

file_put_contents(getcwd() . '/xt/includes/config.inc.php',$file);

if(XT::getValue('system_password') != ''){
    if((XT::getValue('system_password') == XT::getValue('system_password_confirm'))){
        XT::query("
            UPDATE
                " . XT::getValue('database_prefix') . "user
            SET
                password = '" . md5(XT::getValue('system_password') . $GLOBALS['cfg']->get("system", "magic")) . "'
            WHERE
                id = 1
        ",__FILE__,__LINE__);
        XT::log("Password updated",__FILE__,__LINE__,XT_INFO);
    } else {
        XT::log("Password are not identical",__FILE__,__LINE__,XT_ERROR);
    }
}

include(INCLUDE_DIR . "config.inc.php");

header("Location: " . $_SERVER['REQUEST_URI']);
?>