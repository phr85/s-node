<?php
//Include the configuration
require_once('xt/includes/config.inc.php');
//Database connection
require_once(INCLUDE_DIR . "db.inc.php");
// Laod the license

// Get newsletter id and user id from request
$newsletter_id = $_REQUEST['newsletter_id'];
$user_id = $_REQUEST['user_id'];
// mark newsletter as read if both parameters are set
if (is_numeric($newsletter_id) && is_numeric($user_id)) {
	$GLOBALS['db']->query("DELETE FROM " . $GLOBALS['cfg']->get("database","prefix") . "newsletter_views WHERE newsletter_id=" . $newsletter_id . " AND user_id=" . $user_id);
	$GLOBALS['db']->query("INSERT INTO " . $GLOBALS['cfg']->get("database","prefix") . "newsletter_views (newsletter_id,user_id,date) VALUES ('" . $newsletter_id . "','" . $user_id . "','" . time() . "')");
}

// Close the database connection
$GLOBALS['db']->close();

header ("Content-type: image/png");
$im = @imagecreatetruecolor(1, 1);
imagepng($im);
imagedestroy($im);
?>
