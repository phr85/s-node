<?php

// Copy default template
if(is_file(XT::getValue('path'))){
    $content = file_get_contents(XT::getValue('path'));
    XT::setValue('path',str_replace('/default/','/' . $_SESSION['theme'] . '/', XT::getValue('path')));
    
    mkdirs(XT::getValue('path'));

    $file = fopen(XT::getValue('path'),"w");
    fwrite($file, $content);
    fclose($file);
    
    XT::setAdminModule('et');
    
    
} else {
    XT::log("File does not exist",__FILE__,__LINE__,XT_ERROR);
}

function mkdirs($dirname){
    $dir = split("/", trim($dirname));
    for($i = 0; $i < count($dir); $i++){
        if(substr($dir[$i],-4) != '.tpl'){
            $path .= $dir[$i]."/";
            if(!is_dir($path)){
                @mkdir($path,0777);
                @chmod($path,0777);
            }
        }
    }
    
    if(is_dir($dirname)){
        return 1;
    } else {
        return 0;
    }
}

?>