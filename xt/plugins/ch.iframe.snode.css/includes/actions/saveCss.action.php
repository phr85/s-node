<?php

if (XT::getValue("theme") == "default") {
	$file = BASE_DIR . STYLES_DIR . "live/" . XT::getValue("file");
} else {
	$file = BASE_DIR . STYLES_DIR . "live/".  XT::getValue("theme") . "/" . XT::getValue("file");
}
$code = XT::getValue("code");
$code = str_replace("\'","'",$code);
$code = str_replace('\"','"',$code);
file_put_contents ( $file , $code );
$GLOBALS['plugin']->setAdminModule("e");
?>