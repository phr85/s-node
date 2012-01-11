<?php
// Enable page navigator
XT::enableAdminNavigator('search_notfound', 'kw', "SELECT count(kw) as count_id FROM " . $GLOBALS['plugin']->getTable('search_notfound') . " as f WHERE kw='" . $GLOBALS['plugin']->getValue('kw') . "'");
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

$result = XT::query("
    SELECT
        id,
        search_date as sd,
        session_id as users,
        kw
    FROM
        " . $GLOBALS['plugin']->getTable('search_notfound') . " WHERE kw='" . $GLOBALS['plugin']->getValue('kw') . "'
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
