<?php
// Enable page navigator
XT::enableAdminCharFilter('kw');
XT::enableAdminNavigator('search_notfound', 'id', "SELECT count(distinct(kw)) as count_id FROM " . $GLOBALS['plugin']->getTable('search_notfound') . $GLOBALS['plugin']->getCharFilter());
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

$result = XT::query("
    SELECT
        id,
        max(search_date) as sd,
        count(distinct session_id) as users,
        kw,
        count(kw) as kwcount
    FROM
        " . $GLOBALS['plugin']->getTable('search_notfound') . $GLOBALS['plugin']->getCharFilter() . "
    GROUP by
        kw
    ORDER BY
        kwcount DESC
    LIMIT
        " . $GLOBALS['plugin']->getLimiter() . "
    ",__FILE__,__LINE__);

$data = array();
$in='';
while($row = $result->FetchRow()){
    $data[] = $row;
}


XT::assign("DATA", $data);

// Fetch content
$content = XT::build("notfound.tpl");
?>
