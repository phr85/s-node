<?php
if (XT::getValue("theme") != "default" && XT::getValue("theme") != "") {
	$source = BASE_DIR . STYLES_DIR . "live/" . XT::getValue("file");
	$dest = BASE_DIR . STYLES_DIR . "live/".  XT::getValue("theme") . "/" . XT::getValue("file");
	if (!copy($source, $dest)) {
    	 XT::log("Cann't copy " . XT::getValue("file"),__FILE__,__LINE__,XT_ERROR);
	}
}
?>