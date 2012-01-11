<?php
// Enable page navigator
XT::enableAdminCharFilter('w.kw');
XT::enableAdminNavigator('search_found', 'kw_id', "SELECT count(distinct(f.kw_id)) as count_id FROM " . $GLOBALS['plugin']->getTable('search_found') . " as f LEFT JOIN " . $GLOBALS['plugin']->getTable('search_kw') . " as w ON (f.kw_id = w.id) ". $GLOBALS['plugin']->getCharFilter());
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

$result = XT::query("
    SELECT
        f.kw_id as id,
        w.kw,
        count(f.kw_id) as kwcount,
        count(distinct session_id) as users,
        max(f.search_date) as sd,
        f.profile
    FROM
        " . $GLOBALS['plugin']->getTable('search_found') . " as f
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable('search_kw') . " as w ON (f.kw_id = w.id)
    " . $GLOBALS['plugin']->getCharFilter() . "
    GROUP BY
        f.kw_id
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
$content = XT::build("lastsearched.tpl");
?>
