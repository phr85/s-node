<?php

// Get task list
$result = XT::query("
    SELECT
        a.id,
        a.title,
        a.priority,
        a.text,
        a.status,
        b.username as sender,
        a.deadline - " . time() . " as time_diff
    FROM
        " . XT::getTable('user') . " as b,
        " . XT::getTable('tasks') . " as a
    WHERE
        a.receiver = " . XT::getUserID() . " AND
        b.id = a.sender AND
        a.active = 1
        " . XT::getAdminCharFilter('AND') . "
    GROUP BY
        a.id
    ORDER BY
        a.deadline ASC,
        a.id DESC
    LIMIT
        10
    ",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){

    // Calculate time to end
    $time_diff = $row['time_diff'];
    $time_diff_days = floor($time_diff / 86400);
    $time_diff_rest = $time_diff % 86000;
    $time_diff_hours = floor($time_diff_rest / 3600);
    $time_diff_rest = $time_diff_rest % 3600;
    $time_diff_minutes = floor($time_diff_rest / 60);

    // Format time to end
    $time_to_end = '';
    $time_diff_days > 0 ? $time_to_end .= $time_diff_days . ' d ' : null;
    $time_diff_hours > 0 ? $time_to_end .= $time_diff_hours . ' h ' : null;
    $time_diff_minutes > 0 ? $time_to_end .= $time_diff_minutes . ' m ' : null;

    // must be a valid day count
    if($time_diff_days < 365){
        $row['time_to_end'] = $time_to_end;
    }

    $data[] = $row;
}

XT::assign("OPEN_TASKS", $data);

$content = XT::build('default.tpl');

?>
