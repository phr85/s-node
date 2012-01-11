<?php

XT::query("
    UPDATE 
        " . XT::getTable('feedreader_feeds') . "
    SET 
        active = 1 
    WHERE 
        id = " . XT::getValue('feed_id')
,__FILE__,__LINE__);

?>