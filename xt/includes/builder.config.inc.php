<?php

/**
 * define basic constants
 */
define("XT",                true);				                 // XT system definer
define("ROOT_DIR",          getcwd() . "/xt/");				     // root directory
define("WEBROOT_DIR",       getcwd() . "/");			         // web root directory
define("INCLUDE_DIR",       ROOT_DIR . "includes/");		     // include files
define("DATA_DIR",          ROOT_DIR . "data/");		         // data, files
define("PLUGIN_DIR",        ROOT_DIR . "plugins/");		         // plugins
define("LOG_DIR",           ROOT_DIR . "log/");                  // log files
define("TEMPLATE_DIR",      ROOT_DIR . "templates/");		     // templates
define("COMPILE_DIR",       ROOT_DIR . "templates_c/");		     // compiled templates
define("CACHE_DIR",         ROOT_DIR . "cache/");		         // cache files
define("CLASS_DIR",         INCLUDE_DIR . "classes/");		     // class files
define("FUNC_DIR",          INCLUDE_DIR . "functions/");		 // functions files
define("LANG_DIR",          INCLUDE_DIR . "lang/");			     // system translations
define("FONT_DIR",          WEBROOT_DIR . "fonts/");	         // fonts
define("IMAGE_DIR",         "/images/");            		     // images
define("STYLES_DIR",        "/styles/");            		     // images
define("TOOLS_DIR",         "/tools/");            		     // images
define("SCRIPTS_DIR",       "/scripts/");            		     // images
define("REL_ROOT",          "/");            		     // images
define("ADMIN_IMAGE_DIR",   IMAGE_DIR . "admin/");               // admin images
define("ICON_DIR",          IMAGE_DIR . "icons/");               // icons
define("TIME",              time());                             // Script call time
define("PERM_TPL",          109);                                // TPL for the package permissions
define("PERM_BASEID",       140);                                // TPL for the package permissions

/**
 * error constants
 */
define("XT_ERROR",    1);   // Fatal errors
define("XT_DB_ERROR", 2);   // Database errors
define("XT_WARNING",  4);   // Warnings
define("XT_NOTICE",   8);   // Notices
define("XT_INFO",     16);  // Informations

/**
 * include configuration class
 */
require_once("classes/config.class.php");

/**
 * create configuration object
 */
global $cfg;
$cfg = new XT_Config();

/**
 * configuration :: database
 */
$database = $cfg->addSection("database");

$cfg->set($database, "host", 		     "localhost");     // database hostname
$cfg->set($database, "user", 		     "xtbuilder"); // database user
$cfg->set($database, "pass", 		     "xxttbbuuiillddeerr"); // database password
$cfg->set($database, "database", 	     "snode_builder"); // database name
$cfg->set($database, "prefix", 		     "xt_");   // database table prefix
$cfg->set($database, "type", 		     "mysql");               // database type
$cfg->set($database, "persistent", 	     "false");               // connect persistent


/**
 * configuration :: available languages
 */
$lang = $cfg->addSection("lang");
$cfg->addLanguage('de', 'German');
//$cfg->addLanguage('en', 'English');
$cfg->set($lang, "default", "de");

/**
 * configuration :: system
 */
$system = $cfg->addSection("system");

$cfg->set($system, "name",                  "S-Node XT");       // System Name
$cfg->set($system, "version",               "$Id: config.inc.php 1184 2005-07-28 13:08:52Z vzaech $");                // System Version
$cfg->set($system, "tpl",                   10000);                 // Start Template
$cfg->set($system, "tpl_login", 	        99);                    // Login Template
$cfg->set($system, "magic", 		        "fji2UrGT786");         // Magic Key (Change it for better security)
$cfg->set($system, "tracking_mode",         0);                     // User Tracking Mode (0 , Disable Tracking, 1 , Only Logged in Users, 2 , All Users
$cfg->set($system, "benchmarking", 	        false);                 // Enable Benchmarking (Displays parse time)
$cfg->set($system, "email", 		        "info@iframe.ch");      // System E-Mail
$cfg->set($system, "theme",                 "clean1");             // System Style
$cfg->set($system, "debug",                 false);                 // Debugging On / Off
$cfg->set($system, "compression",           true);// Use gzip compressed output
$cfg->set($system, "caching",               false);                 // Use caching
$cfg->set($system, "error_reporting",       E_ALL && ~E_NOTICE);                 // Which error reporting level should be used
$cfg->set($system, "template_security",     true); // Enables or disables Smarty Security (e.g. PHP Execution in templates)
$cfg->set($system, "base_meta_title",       "S-Node XT - "); // Defines the Meta title prefix
$cfg->set($system, "base_meta_description", "Description"); // Defines the Meta description base
$cfg->set($system, "base_meta_keywords",    "Keywords");    // Defines the Meta keywords base
$cfg->set($system, "base_meta_author",      "Roger Dudler");      // Defines the Meta author default
$cfg->set($system, "base_meta_copyright",   "iframe AG");   // Defines the Meta copyright default

/**
 * configuration :: authentication
 */
$auth = $cfg->addSection("auth");

$cfg->set($auth, "mode", "db");          // Authentication mode

/**
 * unset unused variables
 */
unset($database);
unset($system);
unset($lang);
unset($auth);

?>
