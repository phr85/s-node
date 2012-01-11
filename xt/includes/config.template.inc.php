<?php
/**
 * Warning: if you want to change some settings or add some new settings, do it in the config.template.inc.php
 * and then click on the save button in System->Settings
 *
 * Hint: if you want to "fixate" some settings just type in the values you want to have
 */

/**
 * define basic constants
 */
define("XT",                true);				                 // XT system definer
define("BASE_DIR",          getcwd());				     // root directory
define("ROOT_DIR",          BASE_DIR . "/xt/");				     // root directory
define("WEBROOT_DIR",       "%WEBROOT_DIR%");	                 // web root directory
define("INCLUDE_DIR",       ROOT_DIR . "includes/");		     // include files
define("DATA_DIR",          ROOT_DIR . "data/");		         // data, files
define("PLUGIN_DIR",        ROOT_DIR . "plugins/");		         // plugins
define("LOG_DIR",           ROOT_DIR . "log/");                  // log files
define("TEMPLATE_DIR",      ROOT_DIR . "templates/");		     // templates
define("PAGES_DIR",         ROOT_DIR . "templates/default/");     // Pages
define("COMPILE_DIR",       ROOT_DIR . "templates_c/");		     // compiled templates
define("CACHE_DIR",         ROOT_DIR . "cache/");		         // cache files
define("LICENCES_DIR",      ROOT_DIR . "licenses/");		         // cache files
define("CLASS_DIR",         INCLUDE_DIR . "classes/");		     // class files
define("FUNC_DIR",          INCLUDE_DIR . "functions/");		 // functions files
define("LANG_DIR",          INCLUDE_DIR . "lang/");			     // system translations
define("FONT_DIR",          BASE_DIR . "/fonts/");	         // fonts
define("IMAGE_DIR",         WEBROOT_DIR . "images/");            // images
define("STYLES_DIR",        WEBROOT_DIR . "styles/");            // styles
define("TOOLS_DIR",         WEBROOT_DIR . "tools/");             // tools
define("SCRIPTS_DIR",       WEBROOT_DIR . "scripts/");           // scripts
define("REL_ROOT",          WEBROOT_DIR);                        // Relative web root
define("ADMIN_IMAGE_DIR",   IMAGE_DIR . "admin/");               // admin images
define("ICON_DIR",          IMAGE_DIR . "icons/");               // icons
define("TIME",              time());                             // Script call time
define("PERM_TPL",          109);                                // TPL for the package permissions
define("PERM_BASEID",       140);                                // TPL for the package permissions
define("ZONES",             '');                                 // Zones use <!--%%XT_ZONE_FOO%%--> in header, footer or page save in config.template.inc for permanent saving

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

$cfg->set($database, "host", 		     "%DATABASE_HOST%");     // database hostname
$cfg->set($database, "user", 		     "%DATABASE_USERNAME%"); // database user
$cfg->set($database, "pass", 		     "%DATABASE_PASSWORD%"); // database password
$cfg->set($database, "database", 	     "%DATABASE_DATABASE%"); // database name
$cfg->set($database, "prefix", 		     "%DATABASE_PREFIX%");   // database table prefix
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

$cfg->set($system, "name",                  "%SYSTEM_NAME%");             // System Name
$cfg->set($system, "tpl",                   "%SYSTEM_TPL%");              // Start Template
$cfg->set($system, "tpl_login", 	        "%SYSTEM_TPL_LOGIN%");        // Login Template
$cfg->set($system, "magic", 		        "fji2UrGT786");               // Magic Key (Change it for better security)
$cfg->set($system, "tracking_mode",         "%SYSTEM_TRACKING_MODE%");    // User Tracking Mode (0 , Disable Tracking, 1 , Only Logged in Users, 2 , All Users
$cfg->set($system, "benchmarking", 	        false);                       // Enable Benchmarking (Displays parse time)
$cfg->set($system, "email", 		        "%SYSTEM_EMAIL%");            // System E-Mail
$cfg->set($system, "theme",                 "%SYSTEM_THEME%");            // System Style
$cfg->set($system, "send_error",			"bug@iframe.ch");			  // Send error to this email. Leave it blank to suppress sending errors
$cfg->set($system, "compression",           true);                        // Use gzip compressed output
$cfg->set($system, "caching",               false);                       // Use caching
$cfg->set($system, "error_reporting",       E_ALL ^ E_NOTICE);            // Which error reporting level should be used
$cfg->set($system, "template_security",     true);                        // Enables or disables Smarty Security (e.g. PHP Execution in templates)
$cfg->set($system, "disable_file_security",         "%SYSTEM_FILE_SECURITY%");                        // Enables or disables the securitychecks for downloads
$cfg->set($system, "base_meta_title",       "%SYSTEM_META_TITLE%");       // Defines the Meta title prefix
$cfg->set($system, "base_meta_description", "%SYSTEM_META_DESCRIPTION%"); // Defines the Meta description base
$cfg->set($system, "base_meta_keywords",    "%SYSTEM_META_KEYWORDS%");    // Defines the Meta keywords base
$cfg->set($system, "base_meta_author",      "%SYSTEM_META_AUTHOR%");      // Defines the Meta author default
$cfg->set($system, "base_meta_copyright",   "%SYSTEM_META_COPYRIGHT%");   // Defines the Meta copyright default
$cfg->set($system, "base_meta_revisit_after",   "%SYSTEM_META_REVISIT_AFTER%");   // Defines  a string such as 45 days which tells the spider how often to visit the page.
$cfg->set($system, "piwik_id",              "%SYSTEM_PIWIK_ID%");         // Piwik Key
$cfg->set($system, "google_analytics_key",  "%SYSTEM_GOOGLE_ANALYTICS_KEY%");         // Google Maps Key
$cfg->set($system, "google_map_key",        "%SYSTEM_GOOGLE_MAP_KEY%");         // Google Maps Key
$cfg->set($system, "order_nr",              "%SYSTEM_ORDER_NR%");         // S-Node.com Order Number
$cfg->set($system, "log_level",             XT_INFO);                     // Log level
$cfg->set($system, "country",               "CH");                        // Default country
$cfg->set($system, "session_life_time",     3600);                        // Default session_life_time

/**
 * configuration :: smtp mail
 */
$smtp = $cfg->addSection("smtp");
// email preferences
$cfg->set($smtp, "Host",               "%SMTP_HOST%");        // Default SMTP server
$cfg->set($smtp, "SMTPAuth",           false);              // turn on SMTP authentication
$cfg->set($smtp, "Username",           "Username");         // SMTP username
$cfg->set($smtp, "Password",           "Password" );        // SMTP password
$cfg->set($smtp, "DefaultFrom",        "%SYSTEM_EMAIL%" );        // SMTP sender
$cfg->set($smtp, "DefaultFromName",    "%SYSTEM_EMAIL%" );        // SMTP sender name


/**
 * configuration :: domain
 * uncomment the following lines if you want to use multiple domainnames for your page
 */

/**
$domain = $cfg->addSection("domain");
$cfg->set($domain, "www.your-domain.com",         10000);                 // Start Template domain1
$cfg->set($domain, "something.your-domain.com",   10088);                 // Start Template domain2
$cfg->set($domain, "www.other-domain.com",        10288);                 // Start Template domain3 (! check your licences if you can do that)
*/

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