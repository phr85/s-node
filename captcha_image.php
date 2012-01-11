<?php
/**
 * S-Node XT Captcha
 *
 * Description
 * ===========
 * Generate a captchaimage based on the class captchaxt.
 *
 * @author Markus Graf <mgraf@iframe.ch>
 * @version $Id$
 * @package S-Node
 * @subpackage Core
 * @copyright Copyright 2005, iframe AG, http://www.iframe.ch
 */
require_once('xt/includes/config.inc.php');
/**
 * set error reporting
 */
error_reporting($GLOBALS['cfg']->get("system", "error_reporting"));

header("Content-type: image/jpeg");
require_once('xt/includes/classes/captchaxt.class.php');
$myCaptcha = new captchaxt();
if ($_REQUEST['name'] != "") {
	$myCaptcha->setName($_REQUEST['name']);
}
$myCaptcha->getrandrom();
//echo $myCaptcha->code;
$myCaptcha->generateImage();
$myCaptcha->displayImage();
?>