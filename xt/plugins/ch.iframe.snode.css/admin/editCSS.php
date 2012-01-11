<?php  
// save buttons
XT::addImageButton('Save','saveCss','default','save.png','edit');

if (XT::getValue("theme") == "default") {
	$file = BASE_DIR . STYLES_DIR . "live/" . XT::getValue("file");
} else {
	$file = BASE_DIR . STYLES_DIR . "live/".  XT::getValue("theme") . "/" . XT::getValue("file");
}
XT::assign("THEME",XT::getValue("theme"));
XT::assign("FILE",XT::getValue("file"));
XT::assign("CODE",file_get_contents($file));
$content = XT::build("edit.tpl");

 ?>