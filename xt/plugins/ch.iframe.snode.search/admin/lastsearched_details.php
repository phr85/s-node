<?php
// Enable page navigator
XT::enableAdminNavigator('', '', "SELECT count(kw_id) as count_id FROM " . $GLOBALS['plugin']->getTable('search_found') . " as f WHERE kw_id='" . $GLOBALS['plugin']->getValue('id') . "'");
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

$result = XT::query("
    SELECT
        f.id,
        f.search_date as sd,
        f.session_id as users,
        w.kw as kw
    FROM
        " . $GLOBALS['plugin']->getTable('search_found') . " as f LEFT JOIN " . $GLOBALS['plugin']->getTable('search_kw') . " as w ON(w.id = f.kw_id) WHERE f.kw_id='" . $GLOBALS['plugin']->getValue('id') . "'
    ORDER BY
        sd DESC
    LIMIT
        " . $GLOBALS['plugin']->getLimiter() . "
    ",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

$usertracker['tpl']    = $GLOBALS['plugin']->getConfig('userTrackerTPL');
$usertracker['module'] = $GLOBALS['plugin']->getConfig('userTrackerModule');
$usertracker['base_id'] = $GLOBALS['plugin']->getConfig('userTrackerBaseID');
XT::assign("UT", $usertracker);
XT::assign("DATA", $data);

// Fetch content
$content = XT::build("notfound_details.tpl");
?>
