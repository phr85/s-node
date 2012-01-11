<?php
// Enable page navigator
XT::enableAdminNavigator('search_assoc_global', 'kw_id', "SELECT count(distinct(kw_id)) as count_id FROM " . $GLOBALS['plugin']->getTable('search_assoc_global'));
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

$result = XT::query("
    SELECT
        a.kw_id as id,
        w.kw,
        count(a.kw_id) as kwcount

    FROM
        " . $GLOBALS['plugin']->getTable('search_assoc_global') . " as a
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable('search_kw') . " as w ON (a.kw_id = w.id)
    GROUP BY
        a.kw_id
    ORDER BY
        kwcount DESC
    LIMIT
        " . $GLOBALS['plugin']->getLimiter() . "
    ",__FILE__,__LINE__);
$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}


XT::assign("DATA", $data);

// Fetch content
$content = XT::build("mostused.tpl");
?>
