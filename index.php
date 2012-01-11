<?php

/**
 * Set root folder, you can overwrite this value by including this script from another script and defining the variable $root in the other script
 */
if(!isset($root)){
    $root = getcwd();
}
/**
 * Send default header in utf-8
 */
header('content-type: text/html; charset=utf-8');


/**
 * include configuration
 */
require_once($root . "/xt/includes/config.inc.php");

/**
 * load core license
 */
if(function_exists("zend_loader_install_license")){
    @zend_loader_install_license(LICENCES_DIR . $GLOBALS['cfg']->get("system","order_nr") . "_ch.iframe.snode.core.zl",1);
}

/**
 * start benchmarking
 */
$GLOBALS['cfg']->get("system","benchmarking") ? $time_start = microtime(true) : null;

/**
 * start output buffering
 */
$GLOBALS['cfg']->get("system","compression") ? ob_start("ob_gzhandler") : ob_start();

/**
 * set locales
 */
setlocale (LC_TIME, 'de_DE@euro', 'de_CH', 'de', 'ge');

/**
 * set error reporting
 */
error_reporting($GLOBALS['cfg']->get("system", "error_reporting"));

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
//require_once(INCLUDE_DIR . "compatibility.inc.php");    // Compatibility for PHP < 5.0
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

// css and scriptloader
global $loadedcss;
global $loadedscripts;

/**
 * load language stuff
 */
require_once(INCLUDE_DIR . "lang.inc.php");


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
global $relations;

/**
 * create objects
 */
$GLOBALS['logger']  = new XT_Logger();
$GLOBALS['usr']     = new XT_User();

/**
 * Get and set requested template if there is one
 */
global $tpl_id;
if(is_numeric(addslashes(@$_REQUEST['TPL']))){
    $tpl_id = addslashes($_REQUEST['TPL']);
}else{
    // get default tpl for the requested domain
    if($GLOBALS['cfg']->get("domain", $_SERVER['HTTP_HOST'])){
        $tpl_id = $GLOBALS['cfg']->get("domain", $_SERVER['HTTP_HOST']);
    }else{
        $tpl_id = $GLOBALS['cfg']->get("system", "tpl");
    }
}

// Initialize content stack
global $pagecontents;
$GLOBALS['pagecontents'] = array();

// Get template information
global $pagetitle;

$GLOBALS['pagetitle'] = 'Unknown';
$GLOBALS['realtitle'] = 'Unknown';

if(LANGFILE !='LANGFILE'){
    XT::assign("INDEX_PHP", LANGFILE);
}else{
    XT::assign("INDEX_PHP", 'index.php');
}

// Assign default values
XT::assign("TIME", TIME);
XT::assign("SYSTEM_LANG", $GLOBALS['lang']->getLang());
XT::assign("SYSTEM_NAME", $GLOBALS['cfg']->get("system","name"));
XT::assign("SYSTEM_EMAIL", $GLOBALS['cfg']->get("system","email"));
XT::assign("SYSTEM_META_TITLE", $GLOBALS['cfg']->get("system","base_meta_title"));
XT::assign("SYSTEM_META_DESCRIPTION", $GLOBALS['cfg']->get("system","base_meta_description"));
XT::assign("SYSTEM_META_KEYWORDS", $GLOBALS['cfg']->get("system","base_meta_keywords"));
XT::assign("SYSTEM_META_COPYRIGHT", $GLOBALS['cfg']->get("system","base_meta_copyright"));
XT::assign("SYSTEM_META_AUTHOR", $GLOBALS['cfg']->get("system","base_meta_author"));
XT::assign("SYSTEM_META_REVISIT_AFTER", $GLOBALS['cfg']->get("system","base_meta_revisit_after"));
XT::assign("SYSTEM_PIWIK_ID", $GLOBALS['cfg']->get("system","piwik_id"));
XT::assign("SYSTEM_GOOGLE_ANALYTICS_KEY", $GLOBALS['cfg']->get("system","google_analytics_key"));
XT::assign("SYSTEM_GOOGLE_MAP_KEY", $GLOBALS['cfg']->get("system","google_map_key"));
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

// Get all information for a reuested tpl/page
global $application;
$application = new XT_Application();


$result = XT::query("
    SELECT
        a.node_id,
        a.title,
        a.pagetitle,
        a.tpl_file,
        a.live,
        a.active,
        a.cache,
        a.public,
        a.description,
        a.keywords,
        a.author,
		a.revisit_after,
        a.copyright,
        a.c_lang,
        a.header,
        a.footer,
        a.css,
        a.image
    FROM
       " . XT::getDatabasePrefix() . "navigation_details as a
    WHERE
        a.node_id = " . $tpl_id . "
        AND a.lang = '" . $GLOBALS['lang']->getLang() . "'",__FILE__,__LINE__);

if($row = $result->FetchRow()){

     /**
     * get template information and assign them
     */

    // if this page is not public
    if($row['public'] != 1){
        // Check permissions
        if(!XT::getNodePermission($row['node_id'],5,$GLOBALS['application']->getParentID())){
            header("Location: " . $_SERVER['PHP_SELF'] . "?TPL=" . $GLOBALS['cfg']->get("system", "tpl_login") . "&x110_url=" . urlencode($_SERVER['REQUEST_URI']));
            die();
        }
    }

    $GLOBALS['pagetitle'] = $GLOBALS['cfg']->get("system", "base_meta_title") . $row['title'] ;
    $GLOBALS['realtitle'] = $row['title'];
    if(!empty($row['pagetitle'])){
        $GLOBALS['pagetitle'] = $row['pagetitle'] . " " .  $GLOBALS['cfg']->get("system", "base_meta_title");
        $GLOBALS['realtitle'] = $row['pagetitle'];
    }

    XT::assign("TPL_TITLE", $GLOBALS['pagetitle']);
    XT::assign("TPL_REAL_TITLE", $row['title']);
    XT::assign("TPL_FILE", $row['tpl_file']);
    XT::assign("TPL_ACTIVE", $row['active']);
    XT::assign("TPL_HEADER", $row['header']);
    XT::assign("TPL_FOOTER", $row['footer']);
    XT::assign("TPL_CSS", $row['css']);
    XT::assign("TPL_IMAGE", $row['image']);
    XT::assign("TPL_DESC", $row['description']);
    XT::assign("WAY", $GLOBALS['application']->getWayInfo());
    //inherited headimage
    foreach ($GLOBALS['application']->getWayInfo() as $key => $value){
        if($value['headimage'] > 0){
            $headimg = $value['headimage'];
        }
    }
    // get image type
    if($headimg > 0){
        $result = XT::query("SELECT type FROM " . XT::getDatabasePrefix() . "files WHERE id = " . $headimg,__FILE__,__LINE__);
    }
    $headimg_type= $result->FetchRow();
    XT::assign("HEADIMAGE_TYPE", $headimg_type['type']);
    XT::assign("HEADIMAGE", $headimg);
    unset($headimg);

    // Add page to content stack
    XT::addToContentStack(60,$row['node_id'], $row['title']);

    $meta_description = $row['description'] != '' ? $row['description'] : $GLOBALS['cfg']->get("system", "base_meta_description");
    global $pagedescription;
    $GLOBALS['pagedescription'] = $meta_description;

    $meta_keywords = $row['keywords'] != '' ? $row['keywords'] : $GLOBALS['cfg']->get("system", "base_meta_keywords");
    global $pagekeywords;
    $GLOBALS['pagekeywords'] = $meta_keywords;

    $meta_author = $row['author'] != '' ? $row['author'] : $GLOBALS['cfg']->get("system", "base_meta_author");
    $meta_copyright = $row['copyright'] != '' ? $row['copyright'] : $GLOBALS['cfg']->get("system", "base_meta_copyright");
    $meta_revisit_after = $row['revisit_after'] != '' ? $row['revisit_after'] : $GLOBALS['cfg']->get("system", "base_meta_revisit_after");
    $meta_content_lang = $row['c_lang'];
    $tpl_file = $row['tpl_file'];
    
    XT::assign("TPL",$GLOBALS['tpl_id']);
    /**
     * include meta tags
     */
    require_once(INCLUDE_DIR . "metatags.inc.php");

    /**
     * Assign meta tags
     */
    XT::assign("META", implode("\n   ", $GLOBALS['meta']));

    /**
     * include user tracking
     */
    $GLOBALS['cfg']->get("system","tracking_mode") > 0 ? require_once(INCLUDE_DIR . "tracking.inc.php") : null;

    /**
     * Display requested template
     */
    unset($tpl_buffer);

	if($row['active'] != 1 && !XT::getNodePermission($row['node_id'],8,$GLOBALS['application']->getParentID())){
       $tpl_buffer = "";
        // Display page not available message
        if(!empty($row['header'])){
        	$tpl_buffer = $GLOBALS['tpl']->fetch("includes/header/" . $row['header']);
        } else {
        	$tpl_buffer = $GLOBALS['tpl']->fetch("includes/header/header.tpl");
        }
        $tpl_buffer .= $GLOBALS['tpl']->fetchPage('includes/errorpages/template_notavailable.tpl');
        if(!empty($row['footer'])){
            $tpl_buffer .= $GLOBALS['tpl']->fetch("includes/footer/" . $row['footer']);
        } else {
        	$tpl_buffer .= $GLOBALS['tpl']->fetch("includes/footer/footer.tpl");
        }
        echo processContent($tpl_buffer);
    } else {
		$tpl_buffer = "";
		// Print out the content with header and footer
	    if(!empty($row['header'])){
	        $tpl_buffer = $GLOBALS['tpl']->fetch("includes/header/" . $row['header']);
	    }
	    $tpl_buffer .= $GLOBALS['tpl']->fetchPage($tpl_file);
	    if(!empty($row['footer'])){
	        $tpl_buffer .= $GLOBALS['tpl']->fetch("includes/footer/" . $row['footer']);
	    }
	    echo processContent($tpl_buffer);
	}
} else {
	// Print the error TPL not found
	$tpl_buffer = $GLOBALS['tpl']->fetch("includes/header/header.tpl");
	$tpl_buffer .= $GLOBALS['tpl']->fetchPage('includes/errorpages/template_notfound.tpl');
	$tpl_buffer .= $GLOBALS['tpl']->fetch("includes/footer/footer.tpl");
	echo processContent($tpl_buffer);

}

/**
 * Close database
 */
$GLOBALS['db']->close();
/**
 * display benchmarking results
 */
if($GLOBALS['cfg']->get("system","benchmarking")){
    $time_end = microtime(true);
    $time = $time_end - $time_start;
    echo "\n<!-- parsed in " . $time . "s -->";
}

/**
 * Output contents
 */
ob_end_flush();
?>
