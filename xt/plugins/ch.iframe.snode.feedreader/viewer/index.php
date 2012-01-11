<?php
$style = $GLOBALS['plugin']->getParam('style') != '' ? $GLOBALS['plugin']->getParam('style') : 'default.tpl';

$feed_id = XT::autoval('feed_id',"P",0);
// wert für update setzen
XT::setValue("feed_id",$feed_id);
$show = $GLOBALS['plugin']->getParam('show') != '' ? $GLOBALS['plugin']->getParam('show') : 'all';

$result = XT::query("
            SELECT *
                   FROM
                " . XT::getTable('feedreader_feeds') . "
            WHERE
                id in(" . $feed_id . ") AND active = 1"
, __FILE__, __LINE__);
$data = $result->FetchRow();
XT::assign('FEED', $data);

if ($data["active"] == 1) {
	if(is_numeric($show)){
	    $limit = ' limit 0, ' . $show;
	}else {
	    $limit = '';
	}
	$feeds = explode(",",$feed_id);
	foreach ($feeds as $val){
	    XT::SetValue('id',$val);
	    XT::call('updateFeed');
	}
	$result = XT::query("SELECT * from " . XT::getTable('feedreader_feedcontainer') . " WHERE  feed_id IN (" . $feed_id . ") ORDER by published DESC, position_id DESC" . $limit,__FILE__,__LINE__);
	$items = XT::getQueryData($result);
}

XT::assign('IMAGE', $XT_RSS->image);
XT::assign('ITEMS_COUNT', count($items));
XT::assign('ITEMS', $items);

$content = XT::build($style);

?>