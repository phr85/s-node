<?php
// Enable page navigator
XT::enableAdminCharFilter('two');
XT::enableAdminNavigator('search_kw');
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

$result = XT::query("
    SELECT
        id,
        two,
        kw,
        soundex
    FROM
        " . $GLOBALS['plugin']->getTable('search_kw') . $GLOBALS['plugin']->getCharFilter() . "
    ORDER BY
        kw ASC
    LIMIT
        " . $GLOBALS['plugin']->getLimiter() . "
    ",__FILE__,__LINE__);

$data = array();
$in='';
while($row = $result->FetchRow()){
    $data[] = $row;
    $in .= $row['id'] . ", ";
}
if($in != ''){
    $in = substr($in,0,-2);
    $result = XT::query("
        SELECT
            kw_id,
            count(kw_id) as counter
        FROM
            " . $GLOBALS['plugin']->getTable('search_assoc_global') . "
        WHERE
            kw_id in (" . $in . ")
        GROUP BY
            kw_id
    ",__FILE__,__LINE__);
    $counts = array();
    while($row = $result->FetchRow()){
        $counts[$row['kw_id']] = $row['counter'];
    }
    $result = XT::query("
        SELECT
            kw_id,
            count(kw_id) as counter
        FROM
            " . $GLOBALS['plugin']->getTable('search_found') . "
        WHERE
            kw_id in (" . $in . ")
        GROUP BY
            kw_id
    ",__FILE__,__LINE__);
    $founds = array();
    while($row = $result->FetchRow()){
        $founds[$row['kw_id']] = $row['counter'];
    }
}

XT::assign("DATA", $data);
XT::assign("COUNTS", $counts);
XT::assign("FOUNDS", $founds);

// Fetch content
$content = XT::build("keywords.tpl");

?>
