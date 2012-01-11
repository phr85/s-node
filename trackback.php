<?php
header('content-type: text/html; charset=utf-8');

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
require_once(INCLUDE_DIR . "compatibility.inc.php");    // Compatibility for PHP < 5.0
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


// Get all post values
$url    = $_POST['url'];
$title     = $_POST['title'];
$excerpt   = $_POST['excerpt'];
$blog_name = $_POST['blog_name'];
$charset   = $_POST['charset'];
// Get all values for our system
$cid	   = $_REQUEST['cid'];
$ctype	   = $_REQUEST['ctype'];

$maildata = array();
$maildata['url'] = $url;
$maildata['title'] = $title;
$maildata['excerpt'] = $excerpt;
$maildata['blog_name'] = $blog_name;
$maildata['charset'] = $charset;

if ($charset){
	$charset = strtoupper( trim($charset) );
} else {
	$charset = 'ASCII, UTF-8, ISO-8859-1, JIS, EUC-JP, SJIS';
}
if ( function_exists('mb_convert_encoding') ) { // For international trackbacks
	$title     = mb_convert_encoding($title, 'UTF-8', $charset);
	$excerpt   = mb_convert_encoding($excerpt, 'UTF-8', $charset);
	$blog_name = mb_convert_encoding($blog_name, 'UTF-8', $charset);
}

if ( !$cid  || !$ctype ){
	trackback_response(1, 'missing content id or conten type');
} else {
	if (empty($title) && empty($url) && empty($blog_name)) {
		// If it doesn't look like a trackback at all...
		header('Location: ' . getenv("HTTP_REFERER"));
		exit;
	}

	// Remove html
	$title =  strip_tags( $title );
	$excerpt = strip_tags($excerpt);
	$sql = "SELECT
	 *
	FROM " . $GLOBALS['cfg']->get("database","prefix") . "comments_trackback_incomming
	WHERE
	content_id = " . $cid . " AND
	content_type = " . $ctype . " AND
	source_url = '" . $url . "'
	";
	$result = $GLOBALS['db']->query($sql);
	$row = $result->FetchRow();
	if(is_array($row)){
		trackback_response(1, 'there is still a ping');
	} else {

		$sql = "INSERT INTO
		" . $GLOBALS['cfg']->get("database","prefix") . "comments_trackback_incomming
		(
		active,
		ip_long,
		status,
		content_id,
		content_type,
		source_url,
		title,
		excerpt,
		blog_name,
		date
		) VALUES (
		0,
		" . ip2long($_SERVER['REMOTE_ADDR']) . ",
		0,
		" . $cid . ",
		" . $ctype . ",
		'" . $url . "',
		'" . $title . "',
		'" . $excerpt . "',
		'" . $blog_name . "',
		" . time() . "
		);";
		$GLOBALS['db']->query($sql);
		
		trackback_response();

		// Get last insert id
		$result = XT::query("
		    SELECT id FROM " . $GLOBALS['cfg']->get("database","prefix") . "comments_trackback_incomming ORDER BY id DESC LIMIT 1", __FILE__,__LINE__);
		while($row = $result->FetchRow()){
		    $maildata['id'] = $row['id'];
		}

		// Send moderation email
			require_once(CLASS_DIR . "/phpmailer/class.phpmailer.php");
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->IsHTML(true);
			$mail->Encoding = '7bit';
			$mail->SetLanguage(XT::getLang(),CLASS_DIR . "/phpmailer/language/");
			$mail->FromName = $maildata['blog_name'];
			$mail->From = $_SERVER['SERVER_NAME'];
			$mail->Host = $GLOBALS['cfg']->get('smtp','Host');

			$mail->SMTPAuth = $GLOBALS['cfg']->get('smtp','SMTPAuth');
			if($GLOBALS['cfg']->get('smtp','SMTPAuth')){
				$mail->Username = $GLOBALS['cfg']->get('smtp','Username');
				$mail->Password = $GLOBALS['cfg']->get('smtp','Password');
			}

			$mail->AddAddress($GLOBALS['cfg']->get('system','email'));
			$mail->Subject  = "New Trackback at " .  $_SERVER['SERVER_NAME'] .": ". $maildata['title'];
			XT::assign("MAIL_DATA",$maildata);
			if(is_file(TEMPLATE_DIR . $_SESSION['theme'] . '/ch.iframe.snode.comment/moderate_mail.tpl')){
				$mail->Body     =  $GLOBALS['tpl']->fetch( TEMPLATE_DIR . $_SESSION['theme'] . '/ch.iframe.snode.blog/mail/moderate_trackback.tpl');
			}else {
				$mail->Body     =  $GLOBALS['tpl']->fetch( TEMPLATE_DIR . 'default//ch.iframe.snode.blog/mail/moderate_trackback.tpl');
			}
			if(!$mail->Send()){
				echo $mail->ErrorInfo;
				XT::log($mail->ErrorInfo,__FILE__,__LINE__,XT_ERROR);
			}
	}

}

function trackback_response($error = 0, $error_message = '') {
	header('Content-Type: text/xml; charset=utf-8');
	if ($error) {
		echo '<?xml version="1.0" encoding="utf-8"?'.">\n";
		echo "<response>\n";
		echo "<error>1</error>\n";
		echo "<message>$error_message</message>\n";
		echo "</response>";
		die();
	} else {
		echo '<?xml version="1.0" encoding="utf-8"?'.">\n";
		echo "<response>\n";
		echo "<error>0</error>\n";
		echo "</response>";
	}
}
?>