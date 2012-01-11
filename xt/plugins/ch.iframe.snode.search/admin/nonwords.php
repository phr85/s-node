<?php
// Enable page navigator
XT::enableAdminCharFilter('two');
XT::enableAdminNavigator('search_nonwords');
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

$result = XT::query("
    SELECT
        id,
        two,
        kw
    FROM
        " . $GLOBALS['plugin']->getTable('search_nonwords') . $GLOBALS['plugin']->getCharFilter() . "
    ORDER BY
        kw ASC
    LIMIT
        " . $GLOBALS['plugin']->getLimiter() . "
    ",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("DATA", $data);

// Fetch content
$content = XT::build("nonwords.tpl");
?>
