<?php
XT::setAdminModule("ge");

$result = XT::query("
    SELECT
        MAX(id) + 1 as id
    FROM
        " . XT::getTable("fieldgroups")
,__FILE__,__LINE__);

$row = $result->fetchRow();
$id = $row['id'];
if ($id == '') {
	$id = 1;
}

foreach ($GLOBALS['cfg']->getLangs() as $key => $lang){
    $result = XT::query("
        INSERT INTO
            " . XT::getTable("fieldgroups") . "
            (
                id,
                lang, 
                name
            )
        VALUES
            (
                " . $id . ",
                '" . $key . "',
                ''
            )
    ",__FILE__,__LINE__);
}


XT::setSessionValue("fieldgroup_id", $id);
?>