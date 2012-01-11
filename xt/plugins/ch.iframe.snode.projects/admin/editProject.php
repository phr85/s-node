<?php

$GLOBALS['plugin']->contribute("edit_people_buttons", "Add member", "addMember","user1_add.png","0","");

// Control actions cut, copy
XT::assign("CTRL", $GLOBALS['plugin']->getSessionValue('ctrl_add') | $GLOBALS['plugin']->getSessionValue('ctrl_cut') | $GLOBALS['plugin']->getSessionValue('ctrl_copy'));

if($GLOBALS['plugin']->getValue("project_id") != ''){
    $GLOBALS['plugin']->setSessionValue("project_id", $GLOBALS['plugin']->getValue("project_id"));
}

// Get project data
$result = XT::query("
    SELECT
        *
    FROM
        " . $GLOBALS['plugin']->getTable("projects") . "
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue("project_id") . "
",__FILE__,__LINE__);

$project_data = array();
while($row = $result->FetchRow()){
    $budget_sum = $row['budget_start'] + $row['budget_end'];
    $avg_budget = $budget_sum / 2;
    $project_data[] = $row;
}

XT::assign("PROJECT",$project_data[0]);

// Get customers
$result = XT::query("
    SELECT
        id,
        title
    FROM
        " . $GLOBALS['plugin']->getTable("customers") . "
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("CUSTOMERS",$data);

if(is_numeric($project_data[0]['customer_id'])){

    // Get customers persons
    $result = XT::query("
        SELECT
            id,
            firstName,
            lastName,
            position
        FROM
            " . $GLOBALS['plugin']->getTable("customers_persons") . "
        WHERE
            customer_id = " . $project_data[0]['customer_id'] . "
        ORDER BY
            lastName ASC,
            firstName ASC
    ",__FILE__,__LINE__);

    $data = array();
    while($row = $result->FetchRow()){
        $data[] = $row;
    }

    XT::assign("CUSTOMER_PERSONS",$data);

}

// Get human resources
$result = XT::query("
    SELECT
        id,
        firstName,
        lastName
    FROM
        " . $GLOBALS['plugin']->getTable("employees") . "
    ORDER BY
        lastName ASC,
        firstName ASC
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("EMPLOYEES",$data);

// Get project members
$result = XT::query("
    SELECT
        a.role,
        a.id,
        b.firstName,
        b.lastName
    FROM
        " . $GLOBALS['plugin']->getTable("projects_members") . " as a LEFT JOIN
        " . $GLOBALS['plugin']->getTable("employees") . " as b ON (b.id = a.hr_id)
    WHERE
        a.project_id = " . $GLOBALS['plugin']->getSessionValue("project_id") . "
    ORDER BY
        b.lastName ASC,
        b.firstName ASC
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("MEMBERS",$data);

// Get project steps
$result = XT::query("
    SELECT
        a.l,
        a.r,
        a.level,
        a.pid,
        a.id,
        a.budget,
        floor((a.r-a.l-1)/2) as subs,
        a.title,
        a.duration,
        a.real_duration
    FROM
        " . $GLOBALS['plugin']->getTable("projects_steps") . " as a
    WHERE
        a.project_id = " . $GLOBALS['plugin']->getSessionValue("project_id") . "
        AND a.level > 1
    ORDER BY
        a.l ASC
",__FILE__,__LINE__);

$data = array();
$labels = array();
$counts = array();
$total_duration = 0;
$total_real_duration = 0;
while($row = $result->FetchRow()){
    $counts[$row['pid']]++;

    // Label for this entry
    $labels[$row['id']] = $labels[$row['pid']] . $counts[$row['pid']] . ".";
    $row['label'] = substr($labels[$row['id']],0,-1);

    $total_duration += $row['duration'];
    $total_real_duration += $row['real_duration'];

    $row['real_duration_display'] = round($row['real_duration'] / 86400,2);
    $row['duration_display'] = round($row['duration'] / 86400,2);

    $data[] = $row;
    $last_level = $row['level'];
}

XT::assign("STEPS",$data);

// Step management buttons
if($GLOBALS['plugin']->getSessionValue('ctrl_add') || $GLOBALS['plugin']->getSessionValue('ctrl_cut') || $GLOBALS['plugin']->getSessionValue('ctrl_copy')){
    $GLOBALS['plugin']->contribute('edit_steps_buttons','Cancel', 'cancel','delete.png','0','');
} else {
    (sizeof($data) > 0) ? $GLOBALS['plugin']->contribute("edit_steps_buttons", "Add step", "addStep","gear_add.png","0","") : $GLOBALS['plugin']->contribute("edit_steps_buttons", "Add step", "addFirstStep","gear_add.png","0","");
}

if($total_duration > 0){
    // Calculate per second budget
    XT::assign("PERUNITBUDGET", $avg_budget / $total_duration);
} else {

}

// Calculate end time
XT::assign("END_TIME", $project_data[0]['start_date'] + $total_real_duration);
// Time left (calculated)
XT::assign("TIME_LEFT", round(($project_data[0]['end_date'] - ($project_data[0]['start_date'] + $total_real_duration))/86400,1));
XT::assign("TOTAL_DURATION", round($total_duration/86400,1));
XT::assign("TOTAL_REAL_DURATION", round($total_real_duration/86400,1));

$content = XT::build("editProject.tpl");

?>
