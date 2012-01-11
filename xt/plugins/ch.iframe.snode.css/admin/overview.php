<?php

// Get available themes
$directory = TEMPLATE_DIR;
if($dir = opendir($directory)) {
    while($file = readdir($dir)) {
        if(substr($file,0,1) != '.'){
            $themes[] = $file;
        }
    }
}

if (XT::getValue("theme") == "") {
    if (XT::getSessionValue("theme") == "") {
    	XT::setValue("theme", $_SESSION['theme']);
    }else {
        XT::setValue("theme", XT::getSessionValue("theme"));
    }
}
else {
   XT::setSessionValue("theme", XT::getValue("theme"));
}

XT::assign("THEMES", $themes);
XT::assign("THEME", XT::getValue("theme"));


if (XT::getValue("theme") == "default") {
	$theme = "";
} else {
	$theme = XT::getValue("theme");
}
$files = BASE_DIR . STYLES_DIR . "live/".  $theme. "/*.css";
$i = 0;
foreach(glob($files) as $file) {
	$tmp = explode("/",$file);
	$name = array_pop($tmp);
	$stylesheets[$i]['name'] = $name;
	$stylesheets[$i]['theme'] = $theme;
	$used[] = $name;
	$i++;
}

$files = BASE_DIR . STYLES_DIR . "live/*.css";
foreach(glob($files) as $file) {
	$tmp = explode("/",$file);
	$name = array_pop($tmp);
	if (!in_array($name,$used)) {
		$stylesheets[$i]['name'] = $name;
		$stylesheets[$i]['theme'] = "default";
		$i++;
	}
}

XT::assign("THEME_FILES", $stylesheets);
$content = XT::build("overview.tpl");
?>
