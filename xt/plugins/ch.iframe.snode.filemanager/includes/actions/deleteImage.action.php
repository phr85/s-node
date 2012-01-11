<?php

XT::call('saveFile');
XT::setAdminModule("e");

XT::query("
    UPDATE 
        " . XT::getTable("files") . "
    SET
        image=NULL,
        image_version=NULL
    WHERE
        id=" . XT::getValue("file_id")
,__FILE__,__LINE__);
?>