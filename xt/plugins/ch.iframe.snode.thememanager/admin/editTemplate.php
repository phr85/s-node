<?php

XT::addImageButton('Save','save','default','disk_blue.png',0);

// Get template source
if(is_file(XT::getValue('path'))){
    $file = file_get_contents(XT::getValue('path'));
} else {
    XT::log("Cannot read template file",__FILE__,__LINE__,XT_ERROR);
}

XT::assign("FILE", htmlentities($file));
XT::assign("PATH", XT::getValue('path'));

$content = XT::build('editTemplate.tpl');

?>