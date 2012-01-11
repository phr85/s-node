<?php
$settings = XT::getConfig('settings');
$result = XT::query("SELECT count(*) as cnt FROM " . XT::getTable('forum_postings_alerts') . " WHERE id= '" . XT::getValue('alert_id') . "' AND user = '" . XT::getUserID() . "'",__FILE__,__LINE__);
$count = XT::getQueryData($result);
$counter = $count[0]['cnt'] ;
if($counter== 0){
    // Insert entry
    XT::query("
insert into
    " . XT::getTable('forum_postings_alerts') . "
SET
id= '" . XT::getValue('alert_id') . "',
message = '" . XT::getValue('message') . "',
date = " . time() . ",
user = '" . XT::getUserID() . "' ",__FILE__,__LINE__,0);

     // count bad entries
    $result = XT::query("SELECT count(*) as cnt FROM " . XT::getTable('forum_postings_alerts') . " WHERE id= '" . XT::getValue('alert_id') . "'",__FILE__,__LINE__);
    $count = XT::getQueryData($result);
    $badlevel = $count[0]['cnt'] ;
    // autodisable if bad_level is bigger then allowed value
    if($badlevel >= XT::getConfig('bad_level') && XT::getConfig('bad_level')!=0){
        XT::setValue('thread_id',XT::getValue('alert_id'));
        XT::call('disableThread');
    }
}

header("Location: " . $_SERVER['PHP_SELF'] . "?TPL=" . $settings['topic']['TPL'] . "&x" . $GLOBALS['plugin']->getBaseID() . "_topic_id=" . XT::getValue('topic_id'));
?>