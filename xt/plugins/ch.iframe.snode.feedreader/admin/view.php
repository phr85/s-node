<?php

$result = XT::query("SELECT * from " . XT::getTable('feedreader_feedcontainer') . " WHERE feed_id =" . XT::getValue('feed_id') . " ORDER by published DESC, position_id DESC",__FILE__,__LINE__);
$items = XT::getQueryData($result);


    $result = XT::query("
            SELECT *
                   FROM 
                " . XT::getTable('feedreader_feeds') . " 
            WHERE 
                ID=" . XT::getValue('feed_id') . "
        ", __FILE__, __LINE__);
$data = $result->FetchRow();

XT::assign('FEED', $data);
XT::assign('IMAGE', $XT_RSS->image);
XT::assign('ITEMS_COUNT', count($items));
XT::assign('ITEMS', $items);
$content = XT::build('view.tpl');
?>