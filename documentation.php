<?php
// plugin
if ($_REQUEST['plugin']) {
	$plugin = $_REQUEST['plugin'];
}

// module
if ($_REQUEST['module']) {
	$module = $_REQUEST['module'];
}

// Wtih the parameter doctype we are be able to implement other display types later.
// At the moment the default display type gets the textfile in the doc folder for a module
switch ($_REQUEST['doctype']) {
	default:
	// Take the defaul utf-8 header for normal websites
	header('Content-type: text/html; charset="utf-8"',true);
		// Insert a pre to view the text file as it is
		$content = "<pre>";
		if($plugin && $module) {
			// Load the whole shit
			$file = "xt/plugins/" . $plugin . "/doc/" . $module . ".txt";
			if (file_exists($file) && is_readable($file)) {
				$content .= file_get_contents($file);
			} else {
				$content .= $file . " not found!";
			}
		} else {
			$content .= "No plugin or module is set!";
		}
		$content .= "</pre>";
	break;
}
echo $content;
?>
