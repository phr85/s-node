<?php
header('content-type: text/html; charset=utf-8');
// für den IE, damit auch der nicht einfach alles aus dem cache holt
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Welches Package
if($_REQUEST['package'] == ""){
    die();
}

// Welches Modul
if($_REQUEST['module'] == ""){
    die();
}

/**
 * Set root folder, you can overwrite this value by including this script from another script and defining the variable $root in the other script
 */
if(!$root){
    $root = getcwd();
}

/**
 * include configuration
 */
require_once($root . "/xt/includes/config.inc.php");

if(function_exists("zend_loader_install_license")){
    @zend_loader_install_license(LICENCES_DIR . $GLOBALS['cfg']->get("system","order_nr") . "_ch.iframe.snode.core.zl",1);
}

/**
 * start output buffering
 */
$GLOBALS['cfg']->get("system","compression") ? ob_start("ob_gzhandler") : ob_start();

/**
 * set locales
 */
setlocale (LC_ALL, 'de_DE@euro', 'de_DE', 'de', 'ge');

/**
 * Enable pear compatibility
 */
ini_set("include_path", (CLASS_DIR . "PEAR" . PATH_SEPARATOR . ini_get("include_path")));

/**
 * include classes
 */
require_once(CLASS_DIR . "logger.class.php");           // load logging class
require_once(CLASS_DIR . 'xt.class.php');               // load core api class
require_once(CLASS_DIR . 'user.class.php');             // load user handling class
require_once(CLASS_DIR . 'application.class.php');      // load application class

/**
 * load includes
 */
require_once(INCLUDE_DIR . "db.inc.php");               // database connection
require_once(INCLUDE_DIR . "auth.inc.php");             // authentication

/**
 * load permission class
 */
require(CLASS_DIR . 'perm.class.php');

/**
 * Create permission object
 */
global $perm;
$GLOBALS['perm'] = new XT_Perm();

/**
 * load language stuff
 */
require_once(INCLUDE_DIR . "lang.inc.php");             // multilanguage

global $ajaxmode;
$GLOBALS['ajaxmode'] = true;

/**
 * Set default theme values
 */
if(@$_GET['theme'] != ''){
    $_SESSION['theme'] = addslashes($_GET['theme']);
} else {
    if(!isset($_SESSION['theme']) || $_SESSION['theme'] == ''){
        $_SESSION['theme'] = $GLOBALS['cfg']->get("system", "theme");
    }
}
global $relations;

/**
 * load template engine
 */
require_once(INCLUDE_DIR . "template.inc.php");         // embedded template engine

/**
 * declare global variables
 */
global $logger;     // logger
global $usr;        // user object
global $tpl_id;     // template id

/**
 * create objects
 */
$GLOBALS['logger']  = new XT_Logger();
$GLOBALS['usr']     = new XT_User();


// Initialize content stack
global $pagecontents;
$GLOBALS['pagecontents'] = array();


XT::assign("TIME", TIME);
XT::assign("TPL_TITLE", "Unknown");
XT::assign("TPL_FILE", "Unknown");
XT::assign("TPL_CREATOR", "Unknown");
XT::assign("TPL_ACTIVE", 0);
XT::assign("SYSTEM_LANG", $GLOBALS['lang']->getLang());
XT::assign("SYSTEM_NAME", $GLOBALS['cfg']->get("system","name"));
XT::assign("SYSTEM_EMAIL", $GLOBALS['cfg']->get("system","email"));
XT::assign("SYSTEM_META_TITLE", $GLOBALS['cfg']->get("system","base_meta_title"));
XT::assign("SYSTEM_META_DESCRIPTION", $GLOBALS['cfg']->get("system","base_meta_description"));
XT::assign("SYSTEM_META_KEYWORDS", $GLOBALS['cfg']->get("system","base_meta_keywords"));
XT::assign("SYSTEM_META_COPYRIGHT", $GLOBALS['cfg']->get("system","base_meta_copyright"));
XT::assign("SYSTEM_META_AUTHOR", $GLOBALS['cfg']->get("system","base_meta_author"));
XT::assign("XT_THEME", $GLOBALS['cfg']->get("system","theme"));
XT::assign("AUTH", $GLOBALS['auth']->isAuth());
XT::assign("XT_IMAGES", IMAGE_DIR);
XT::assign("XT_STYLES", STYLES_DIR);
XT::assign("XT_SCRIPTS", SCRIPTS_DIR);
XT::assign("XT_TOOLS", TOOLS_DIR);
XT::assign("XT_WEB_ROOT", REL_ROOT);
XT::assign("THEME",$_SESSION['theme']);
XT::assign("THEME_IMAGES",IMAGE_DIR . $_SESSION['theme'] . "/");

// Assign permanent assigns
if(is_array(@$_SESSION['ASSIGN'])){
    foreach ($_SESSION['ASSIGN'] as $key => $value){
        XT::assign($key, $value);
    }
}



global $application;
$application = new XT_Application();

XT::assign("AJAXMODE",true);
function ajax_get_template($tpl_name, &$tpl_source, &$smarty)
{
    if ($_REQUEST['package'] != "" && $_REQUEST['module'] != "") {
	    $paramstring = '';
		while(list($key,$value) = each($_REQUEST)) {
			if (substr($key,0,strlen("param_")) == "param_"){
				$mykey = str_replace("param_","",$key);
				$paramstring .= $mykey . '="' . $value . '" ';
			}
		}
	    $tpl_source = '{plugin package="' . $_REQUEST['package'] . '" module="' . $_REQUEST['module'] . '" ' . $paramstring . '}';
	    return true;
    } else {
        return false;
    }
}

function ajax_get_timestamp($tpl_name, &$tpl_timestamp, &$smarty)
{
    // Just return the time, because the template is always different
     $tpl_timestamp = time();
     return true;
}

function ajax_get_secure($tpl_name, &$smarty)
{
    // assume all templates are secure
    return true;
}

function ajax_get_trusted($tpl_name, &$smarty)
{
    // not used for templates
}
$GLOBALS['tpl']->register_resource("ajax", array("ajax_get_template",
      "ajax_get_timestamp",
      "ajax_get_secure",
      "ajax_get_trusted"));



/**
 * Output contents
 */
echo processContent($GLOBALS['tpl']->fetchPage('ajax:' . rand(1, 9999) . '.tpl'));
ob_end_flush();
//ob_flush();
/**
 * Close database
 */
$GLOBALS['db']->close();
