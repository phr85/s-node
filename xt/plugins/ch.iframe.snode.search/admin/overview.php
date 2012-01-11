<?php
function_exists("zend_loader_file_licensed") ? XT::checkDomain(zend_loader_file_licensed()) : null;

XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

//NOTFOUNDS --->
$result = XT::query("
    SELECT
        kw,
        count(kw) as kwcount,
        max(search_date) as sd,
        profile
    FROM
        " . $GLOBALS['plugin']->getTable('search_notfound') . "
    GROUP BY
        kw
    ORDER BY
        search_date desc
    LIMIT 0, 10
",__FILE__,__LINE__);
$notfounds = array();
while($row = $result->FetchRow()){
    $notfounds[] = $row;
}
XT::assign("NOTFOUNDS", $notfounds);
//<--- NOTFOUNDS

//MOSTSEARCHED --->
$result = XT::query("
    SELECT
        w.kw,
        count(f.kw_id) as kwcount,
        max(f.search_date) as sd,
        f.profile
    FROM
        " . $GLOBALS['plugin']->getTable('search_found') . " as f,
        " . $GLOBALS['plugin']->getTable('search_kw') . " as w
    WHERE
        f.kw_id = w.id
    GROUP BY
        f.kw_id
    ORDER BY
        kwcount desc
    LIMIT 0, 10
",__FILE__,__LINE__);
$MOSTSEARCHED = array();
while($row = $result->FetchRow()){
    $MOSTSEARCHED[] = $row;
}
XT::assign("MOSTSEARCHED", $MOSTSEARCHED);
//<--- MOSTSEARCHED

//LASTSEARCHED --->
$result = XT::query("
    SELECT
        w.kw,
        count(f.kw_id) as kwcount,
        max(f.search_date) as sd,
        f.profile
    FROM
        " . $GLOBALS['plugin']->getTable('search_found') . " as f
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable('search_kw') . " as w ON f.kw_id = w.id

    GROUP BY
        f.kw_id
    ORDER BY
        sd desc
    LIMIT 0, 10
",__FILE__,__LINE__);
$LASTSEARCHED = array();
while($row = $result->FetchRow()){
    $LASTSEARCHED[] = $row;
}
XT::assign("LASTSEARCHED", $LASTSEARCHED);
//<--- LASTSEARCHED

//---> Stats
$stats = array();
// different users
$result = XT::query("
    SELECT
        count(distinct(session_id)) as cnt
    FROM
        " . $GLOBALS['plugin']->getTable('search_found')
    ,__FILE__,__LINE__);
while($row = $result->FetchRow()){
    $stats['users'] = $row['cnt'];
}

// keywords
$result = XT::query("
    SELECT
        count(id) as cnt
    FROM
        " . $GLOBALS['plugin']->getTable('search_kw')
    ,__FILE__,__LINE__);
while($row = $result->FetchRow()){
    $stats['keywords'] = $row['cnt'];
}

// keywords found
$result = XT::query("
    SELECT
        count(id) as cnt
    FROM
        " . $GLOBALS['plugin']->getTable('search_found')
    ,__FILE__,__LINE__);
while($row = $result->FetchRow()){
    $stats['keywords_found'] = $row['cnt'];
}

// keywords not found
$result = XT::query("
    SELECT
        count(id) as cnt
    FROM
        " . $GLOBALS['plugin']->getTable('search_notfound')
    ,__FILE__,__LINE__);
while($row = $result->FetchRow()){
    $stats['keywords_not_found'] = $row['cnt'];
}

// indexed content
$result = XT::query("
    SELECT
        count(id) as cnt
    FROM
        " . $GLOBALS['plugin']->getTable('search_infos_global')
    ,__FILE__,__LINE__);
while($row = $result->FetchRow()){
    $stats['indexed'] = $row['cnt'];
}

// assocs
$result = XT::query("
    SELECT
        count(info_id) as cnt
    FROM
        " . $GLOBALS['plugin']->getTable('search_assoc_global')
    ,__FILE__,__LINE__);
while($row = $result->FetchRow()){
    $stats['keywords_assigned'] = $row['cnt'];
}
$result = XT::query("
    SELECT
        count(distinct(kw_id)) as cnt
    FROM
        " . $GLOBALS['plugin']->getTable('search_assoc_global')
    ,__FILE__,__LINE__);
while($row = $result->FetchRow()){
    $stats['keywords_diff_assigned'] = $row['cnt'];
}


XT::assign("STATS", $stats);
//<--- Stats

// Fetch content
$content = XT::build("overview.tpl");
?>