<?php

XT::setAdminModule('e');
if(!is_numeric(XT::getValue("refresh_interval"))){
    XT::setValue('refresh_interval',30);
}
if(!is_numeric(XT::getValue("entries"))){
    XT::setValue('entries',20);
}

XT::query("
    UPDATE 
        " . XT::getTable('feedreader_feeds') . "
    SET
        title = '" . addslashes(XT::getValue("title")) . "',
        url = '" . addslashes(XT::getValue("url")) . "',
        mod_date = " . time() . ",
        mod_user = " . XT::getUserID() . ",
        refresh_interval = " . XT::getValue("refresh_interval") . ",
        entries = " . XT::getValue("entries") . "
    WHERE
        id = " . XT::getValue("feed_id") . "
    ",__FILE__,__LINE__);


?>