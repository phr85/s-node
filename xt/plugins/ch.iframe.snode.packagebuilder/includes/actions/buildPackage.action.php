<?php

define('PACKAGENAME',$GLOBALS['plugin']->getValue('package'));

// delete first the previous package and its directory
exec(BIN . " delpackage.sh " . PACKAGENAME);
// read package.xml
require_once(CLASS_DIR . 'xml.class.php');
$xml = new XT_XML();

if(is_file(PLUGIN_DIR . PACKAGENAME . '/package.xml')){
    $packagedata = XML_unserialize(file_get_contents(PLUGIN_DIR . PACKAGENAME . '/package.xml'));
    $packagedata = $packagedata['package'];

    // cleanup
    rmdir_r(PACKAGES . PACKAGENAME);

    // create package directory
    mkdir(PACKAGES . PACKAGENAME, 0777);
    // create the xt directory
    mkdir(PACKAGES . PACKAGENAME . '/xt');
    mkdir(PACKAGES . PACKAGENAME . '/xt/plugins');
    //copy Plugin dir
    copy_r(PLUGIN_DIR . PACKAGENAME, PACKAGES . PACKAGENAME . '/xt/plugins/' . PACKAGENAME);


    //copy template
    if(is_dir(TEMPLATE_DIR . 'default/' . PACKAGENAME)){
        mkdir(PACKAGES . PACKAGENAME . '/xt/templates');
        mkdir(PACKAGES . PACKAGENAME . '/xt/templates/default');
        mkdir(PACKAGES . PACKAGENAME . '/xt/templates/default/_pages');
        copy_r(TEMPLATE_DIR . 'default/' . PACKAGENAME, PACKAGES . PACKAGENAME . '/xt/templates/default/' . PACKAGENAME);
    }else{
        XT::log('No templates? Is this correct?',__FILE__,__LINE__,XT_ERROR);
    }

    //copy the pages
    if($packagedata['page']['id'] != ''){
        $page[0] = $packagedata['page'];
    }else{
        $page = $packagedata['page'];
    }
    if(!is_array($page)){
        $page = array();
    }

    foreach ($page as $pagevalue) {
        foreach ($pagevalue['lang'] as $lang => $langvalues) {
            mkdir(PACKAGES . PACKAGENAME . '/xt/templates');
            mkdir(PACKAGES . PACKAGENAME . '/xt/templates/default');
            mkdir(PACKAGES . PACKAGENAME . '/xt/templates/default/_pages');
            if(!copy(TEMPLATE_DIR . 'default/_pages/' . $langvalues['file'],PACKAGES . PACKAGENAME . '/xt/templates/default/_pages/' . $langvalues['file'])){
                XT::log('defined Page ' . $langvalues['file'] . ' does not exist',__FILE__,__LINE__,XT_ERROR);
            }
        }
    }

    //copy the tipps
    if(is_dir(WEBROOT_DIR . IMAGE_DIR . 'admin/tipps/' . PACKAGENAME)){
        mkdir(PACKAGES . PACKAGENAME . '/images');
        mkdir(PACKAGES . PACKAGENAME . '/images/admin');
        mkdir(PACKAGES . PACKAGENAME . '/images/admin/tipps');
        copy_r(WEBROOT_DIR . IMAGE_DIR . 'admin/tipps/' . PACKAGENAME, PACKAGES . PACKAGENAME . '/images/admin/tipps');
    }

    //copy the defined Folders
    if(!is_array($packagedata['folder'])){
        if($packagedata['folder'] !=''){
            $folder[0] = $packagedata['folder'];
        }else{
            $folder =array();
        }
    }else{
        $folder = $packagedata['folder'];
    }

    foreach ($folder as $foldername){
        if(is_dir($foldername)){
            unset($folders);
            unset($newfolder);
            foreach(explode('/',$foldername) as $folders){
                $newfolder .=  $folders;
                @mkdir(PACKAGES . PACKAGENAME . '/' . $newfolder);
                $newfolder .= '/';
            }
            copy_r($foldername, PACKAGES . PACKAGENAME . '/' . $foldername);
        }else{
            XT::log('Specified directory <b>' . $foldername . '</b> does not exist',__FILE__,__LINE__,XT_ERROR);
        }
    }

    //Exclude requested folders
    if(!is_array($packagedata['excludefolder'])){
        if($packagedata['excludefolder'] !=''){
            $excludefolder[0] = $packagedata['excludefolder'];
        }else{
            $excludefolder =array();
        }
    }else{
        $excludefolder = $packagedata['excludefolder'];
    }
    foreach ($excludefolder as $foldername){
        rmdir_r(PACKAGES . PACKAGENAME . '/' . $foldername);
    }


    //create requested folders
    if(!is_array($packagedata['createfolder'])){
        if($packagedata['createfolder'] !=''){
            $createfolder[0] = $packagedata['createfolder'];
        }else{
            $createfolder =array();
        }
    }else{
        $createfolder = $packagedata['createfolder'];
    }

    foreach ($createfolder as $foldername){
        unset($folders);
        unset($newfolder);
        foreach(explode('/',$foldername) as $folders){
            $newfolder .=  $folders;
            @mkdir(PACKAGES . PACKAGENAME . '/' . $newfolder);
            $newfolder .= '/';
        }
    }


    //Exclude requested files
    if(!is_array($packagedata['excludefile'])){
        if($packagedata['excludefile'] !=''){
            $excludefile[0] = $packagedata['excludefile'];
        }else{
            $excludefile = array();
        }
    }else{
        $excludefile = $packagedata['excludefile'];
    }

    foreach ($excludefile as $filename){
        // echo '<br>deleted: ' . PACKAGES . PACKAGENAME . '/' . $filename;
        unlink(PACKAGES . PACKAGENAME . '/' . $filename);
    }

    //copy the defined Files
    if(!is_array($packagedata['file'])){
        if($packagedata['file'] !=''){
            $file[0] = $packagedata['file'];
        }else{
            $file =array();
        }
    }else{
        $file = $packagedata['file'];
    }
    foreach ($file as $filename) {
        if(is_file($filename)){
            unset($folders);
            unset($newfolder);
            $filebasename =  basename($filename);
            foreach(explode('/',$filename) as $folders){
                if($folders != $filebasename){
                    $newfolder .= '/' . $folders;
                    @mkdir(PACKAGES . PACKAGENAME . '/' . $newfolder);
                }
            }
            if(!@copy($filename, PACKAGES . PACKAGENAME . '/' . $filename)){
                XT::log('Error while copying ' . $filename,__FILE__,__LINE__ );
            }
        }else{
            XT::log('Specified File <b>' . $filename . '</b> does not exist',__FILE__,__LINE__,XT_ERROR);
        }
    }

    //copy files not to be encoded
    if(!is_array($packagedata['openfile'])){
        if($packagedata['openfile'] !=''){
            $openfile[0] = $packagedata['openfile'];
        }else{
            $openfile =array();
        }
    }else{
        $openfile = $packagedata['openfile'];
    }

    foreach ($openfile as $open_filename) {
        if(is_file($open_filename)){
            unset($folders);
            unset($newfolder);
            $filebasename =  basename($open_filename);
            foreach(explode('/',$open_filename) as $folders){
                if($folders != $filebasename){
                    $newfolder .= '/' . $folders;
                    @mkdir(PACKAGES . PACKAGENAME . '/' . $newfolder);
                }
            }
            if(!@copy($open_filename, PACKAGES . PACKAGENAME . '/' . $open_filename)){
                XT::log('Error while copying ' . $filename,__FILE__,__LINE__ );
            }
        }else{
            XT::log('Specified File <b>' . $open_filename . '</b> does not exist',__FILE__,__LINE__,XT_ERROR);
        }
    }


    // Make the Package (ZIP the stuff)
    if(PACKAGENAME == 'ch.iframe.snode.core'){
        if(XT::getValue('encode') == 1){
            echo(BIN . "corezipper.sh " . PACKAGES . PACKAGENAME ." ../" . PACKAGENAME . ".xtp " . '"' . PACKAGENAME . "\" ");
            exec(BIN . "corezipper.sh " . PACKAGES . PACKAGENAME ." ../" . PACKAGENAME . ".xtp " . '"' . PACKAGENAME . "\" ");
        }else {
            exec(BIN . "zipper.sh " . PACKAGES . PACKAGENAME ." ../" . PACKAGENAME . ".xtp " . '"' . PACKAGENAME . "\"");
        }
    }else{
        if(XT::getValue('encode') == 1){
        	
            echo (BIN . "encoder.sh " . PACKAGES . PACKAGENAME . " ../" . PACKAGENAME . ".xtp " . '"' . PACKAGENAME . "\" encode");
            exec(BIN . "encoder.sh " . PACKAGES . PACKAGENAME . " ../" . PACKAGENAME . ".xtp " . '"' . PACKAGENAME . "\" encode");
            foreach ($openfile as $open_filename) {
                if(is_file($open_filename)){
                    unset($folders);
                    unset($newfolder);
                    $filebasename =  basename($open_filename);
                    foreach(explode('/',$open_filename) as $folders){
                        if($folders != $filebasename){
                            $newfolder .= '/' . $folders;
                            @mkdir(PACKAGES . PACKAGENAME . '/' . $newfolder);
                        }
                    }
                    if(!@copy($open_filename, PACKAGES . PACKAGENAME . '/' . $open_filename)){
                        XT::log('Error while copying ' . $filename,__FILE__,__LINE__ );
                    }
                }else{
                    XT::log('Specified File <b>' . $open_filename . '</b> does not exist',__FILE__,__LINE__,XT_ERROR);
                }
            }
            exec(BIN . "zipper.sh " . PACKAGES . PACKAGENAME . " ../" . PACKAGENAME . ".xtp " . '"' . PACKAGENAME . "\" encode");
        } else {
            exec(BIN . "zipper.sh " . PACKAGES . PACKAGENAME ." ../" . PACKAGENAME . ".xtp " . '"' . PACKAGENAME . "\"");
        }
    }
    // End message
    XT::log('You have to compress and <b>encode</b> the package now.',__FILE__,__LINE__,XT_INFO);
    XT::log('is built in <b>' . str_replace('../','',PACKAGES) . '</b>' ,__FILE__,__LINE__,XT_INFO);
    XT::log('Package <b>' . PACKAGENAME .'</b> ',__FILE__,__LINE__,XT_INFO);
}else{
    XT::log('Building a Package withot package.xml is not possible!',__FILE__,__LINE__,XT_ERROR);
}





function copy_r($source, $dest){

    // Simple copy for a file
    if (is_file($source)) {
        return copy($source, $dest);
    }

    // Make destination directory
    if (!is_dir($dest)) {
        mkdir($dest);
    }

    // Loop through the folder
    $dir = dir($source);
    while (false !== $entry = $dir->read()) {
        // Skip pointers
        if ($entry == '.' || $entry == '..' || $entry == '.svn') {
            continue;
        }

        // Deep copy directories
        if ($dest !== "$source/$entry") {
            copy_r("$source/$entry", "$dest/$entry");
        }
    }

    // Clean up
    $dir->close();
    return true;
}

function rmdir_r($dirName) {
    if(empty($dirName)) {
        return;
    }
    if(file_exists($dirName)) {
        $dir = dir($dirName);
        while($file = $dir->read()) {
            if($file != '.' && $file != '..') {
                if(is_dir($dirName.'/'.$file)) {
                    rmdir_r($dirName.'/'.$file);
                } else {
                    @unlink($dirName.'/'.$file) or die('File '.$dirName.'/'.$file.' couldn\'t be deleted!');
                }
            }
        }
        @rmdir($dirName.'/'.$file) or die('Folder '.$dirName.'/'.$file.' couldn\'t be deleted!');
    }
}
?>