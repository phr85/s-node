<?php

// Get statistics
$data = file_get_contents(DATA_DIR . "stats/" . $GLOBALS['plugin']->getValue("start_date") . "_" . $GLOBALS['plugin']->getValue("end_date") . ".snodestats","w+");
$unserialized = unserialize($data);

$views = count($unserialized);
XT::assign("TOTAL_VIEWS", $views);

global $sessions;
global $pages;
global $agents;
global $hosts;
global $views;
global $last_session;

$GLOBALS['last_session'] = '';
$GLOBALS['sessions'] = array();
$GLOBALS['pages'] = array();
$GLOBALS['agents'] = array();
$GLOBALS['hosts'] = array();
$GLOBALS['users'] = array();
$GLOBALS['days'] = array();
$GLOBALS['views'] = 0;

array_walk($unserialized, "parse_entry");

function parse_entry($item, $key){
    $GLOBALS['sessions'][$item['session_id']][] = $item;
    $GLOBALS['pages'][$item['tpl']]++;
    $GLOBALS['agents'][$item['agent']]++;
    $GLOBALS['hosts'][$item['host']]++;
    $GLOBALS['users'][$item['user_id']]++;
    $time = getdate($item['call_time']);
    $GLOBALS['days'][$time['yday']]['viewcount']++;
    $GLOBALS['views']++;

    // If it is a new session
    if($item['session_id'] != $GLOBALS['last_session']){
        $GLOBALS['days'][$time['yday']]['visitorcount']++;
        $GLOBALS['last_session'] = $item['session_id'];
    }
}

$visitorcount = count($GLOBALS['sessions']);

// Total visitors count
XT::assign("VISITORCOUNT", $visitorcount);

// Total views count
XT::assign("VIEWSCOUNT", $GLOBALS['views']);

// Different pages count
XT::assign("PAGESCOUNT", count($GLOBALS['pages']));

// Different browsers
XT::assign("AGENTSCOUNT", count($GLOBALS['agents']));

// Different hosts
XT::assign("HOSTSCOUNT", count($GLOBALS['hosts']));

// Different users
XT::assign("USERSCOUNT", count($GLOBALS['users']));

// Total day count
XT::assign("DAYCOUNT", count($GLOBALS['days']));

// Sort by day visitors
arsort($GLOBALS['pages']);
XT::assign("DAYS", $GLOBALS['days']);

$keys = array_keys($GLOBALS['days']);
for($i = min($keys); $i <= max($keys); $i++){
    $day_visitors[$i] = $GLOBALS['days'][$i]['visitorcount'] ? $GLOBALS['days'][$i]['visitorcount'] : 0;
    $day_views[$i] = $GLOBALS['days'][$i]['viewcount'] ? $GLOBALS['days'][$i]['viewcount'] : 0;
}

XT::assign("DAYVISITORS", $day_visitors);
XT::assign("DAYVIEWS", $day_views);

// View per day
XT::assign("VIEWSPERDAY", $GLOBALS['days']);

// Average visitor count per day
XT::assign("AVGVISITORSPERDAY", ceil($visitorcount / count($GLOBALS['days'])));

// Average view count per day
XT::assign("AVGVIEWSPERDAY", ceil($GLOBALS['views'] / count($GLOBALS['days'])));

// Sort by page calls
arsort($GLOBALS['pages']);

// Graph units
XT::assign("PERUNIT", 600 / $GLOBALS['views']);
XT::assign("PERDAYUNIT", 600 / $visitorcount);
XT::assign("PERDAYVIEWSUNIT", 600 / $GLOBALS['views']);

// Build in
$in = implode(',',array_keys($GLOBALS['pages']));

// Get page details
$result = XT::query("
    SELECT
        node_id,
        title
    FROM
        " . $GLOBALS['plugin']->getTable("navigation_details") . "
    WHERE
        node_id IN (" . $in . ")
        AND lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
    ",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[$row['node_id']] = $row;
}
XT::assign("PAGEDATA", $data);
XT::assign("PAGES", $GLOBALS['pages']);

$content = XT::build("view.tpl");

?>
