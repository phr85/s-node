<?php
if(isset($_FILES['file']) && $_FILES['file']['name'] != ''){
    if(!XT::getSessionValue("file")){
            if(move_uploaded_file($_FILES['file']['tmp_name'], $GLOBALS['plugin']->getConfig('temp_file_upload_dir') . $_FILES['file']['name'])){
            XT::setSessionValue("file",$_FILES['file']);
            XT::assign("FILENAME",XT::getSessionValue("file"));
        }
    }
}else {
    XT::assign("FILENAME",XT::getSessionValue("file"));
}

?>