<?php

$result = XT::query("
    SELECT count(id) as count_id FROM " . $GLOBALS['cfg']->get("database","prefix") . "messages WHERE receiver = " . XT::getUserID() . " AND read_date = 0 AND deleted = 0
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("MESSAGECOUNT",$data[0]['count_id']);

$result = XT::query("
    SELECT count(id) as count_id FROM " . $GLOBALS['cfg']->get("database","prefix") . "tasks WHERE receiver = " . XT::getUserID() . " AND read_date = 0 AND deleted = 0
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("TASKCOUNT",$data[0]['count_id']);

$content = XT::build("default.tpl");

?>
