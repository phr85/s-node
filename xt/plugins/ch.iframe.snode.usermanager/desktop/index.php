<?php

$result = XT::query("
    SELECT
        b.username,
        b.id,
        a.call_time
    FROM
        " . $GLOBALS['cfg']->get("database","prefix") . "tracking as a LEFT JOIN
        " . $GLOBALS['cfg']->get("database","prefix") . "user as b ON (b.id = a.user_id)
    WHERE
        a.user_id != 0
        AND " . time() . " - call_time < 60*5
    GROUP BY
        a.user_id
    ORDER BY
        a.call_time DESC
    LIMIT 10
",__FILE__,__LINE__,0);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("USERS",$data);

$result = XT::query("
    SELECT
        a.session_id
    FROM
        " . $GLOBALS['cfg']->get("database","prefix") . "tracking as a
    WHERE
        (" . time() . " - a.call_time) < 60*5
    GROUP BY
        a.session_id
",__FILE__,__LINE__,0);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("GUESTS", sizeof($data[0]));

$content = XT::build("default.tpl");

?>
