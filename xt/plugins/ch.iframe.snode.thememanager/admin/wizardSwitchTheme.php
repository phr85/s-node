<?php

// Get available themes
$directory = TEMPLATE_DIR;
if($dir = opendir($directory)) {
    while($file = readdir($dir)) {
        if(substr($file,0,1) != '.'){
            if($file != $_SESSION['theme']){
                $themes[] = $file;
            }
        }
    }
}
XT::assign("THEMES", $themes);

$content = XT::build('wizardSwitchTheme.tpl');

?>