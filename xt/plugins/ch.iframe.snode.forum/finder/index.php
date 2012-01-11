<?php
if(is_numeric(XT::getValue("topic_id"))){
    $find = "topic";
}

if(is_numeric(XT::getValue("entry_id"))){
    $find = "entry";
}

switch ($find) {
    case 'topic':
        // Get topic details
        $result = XT::query("SELECT a.id, a.forum_id FROM " . XT::getTable('forum_topics') . " as a WHERE a.id = '" . XT::getValue("topic_id") . "'",__FILE__,__LINE__);
        $topic = XT::getQueryData($result);
        if(is_array($topic)){
            header("Location: /index.php?TPL=" . $settings['topic']['TPL'] . "&x3600_topic_id=" . $topic[0]['id'] . "&x3600_forum_id=" . $topic[0]['forum_id'] . "");
        }
        break;
        
        
    case 'entry':
        // Get topic details
        $result = XT::query("SELECT a.id, a.forum_id FROM " . XT::getTable('forum_topics') . " as a 
        INNER JOIN " . XT::getTable('forum_postings') . " as b on (a.id = b.topic_id)
        WHERE b.id = '" . XT::getValue("entry_id") . "'",__FILE__,__LINE__,0);
        $topic = XT::getQueryData($result);
        // find page
        // Get position
        $result = XT::query("SELECT count(id) as count_id FROM " . XT::getTable('forum_postings') . " WHERE  topic_id = '" . $topic[0]['id'] . "' AND level = 2 AND id <= " . XT::getValue('entry_id'),__FILE__,__LINE__);
        $row = $result->FetchRow();
        $position = $row['count_id'];
        $topic[0]['page'] = ceil($position/XT::getConfig('postings_per_page'));
        if(is_array($topic)){
           header("Location: /index.php?TPL=" . $settings['topic']['TPL'] . "&x3600_entry_id=" . $topic[0]['id'] . "&x3600_forum_id=" . $topic[0]['forum_id'] . "&x3600_page=" . $topic[0]['page'] . "");
        }
        break;

        break;

    default:
        break;
}

?>