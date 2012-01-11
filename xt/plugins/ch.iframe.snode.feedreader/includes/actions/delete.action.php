<?php

XT::query("
    DELETE FROM 
        " . XT::getTable('feedreader_feeds') . " 
    WHERE 
        id = " . XT::getValue('feed_id')
,__FILE__,__LINE__);

XT::query("
    DELETE FROM 
        " . XT::getTable('feedreader_feedcontainer') . " 
    WHERE 
        feed_id = " . XT::getValue('feed_id')
,__FILE__,__LINE__);

?>