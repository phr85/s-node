<?php

XT::query("
    UPDATE 
        " . XT::getTable('galleries_rel') . " 
    SET 
        active = 1 
    WHERE 
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND 
        gallery_id = '" . XT::getSessionValue('open') . "' AND
        file_id = " . XT::getValue('file')
,__FILE__,__LINE__);

?>