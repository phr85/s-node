<?php

function_exists("zend_loader_file_licensed") ? XT::checkDomain(zend_loader_file_licensed()) : null;

// Choosed date
$active_month = date('n');
$active_year = date('Y');

// Actual date
$date = getdate(time());
XT::assign("DATE", $date);

// Years
$result = XT::query("
    SELECT
        *
    FROM 
        " . XT::getTable("years") . "
",__FILE__,__LINE__);

$data = array();
$total_views = 0;
while($row = $result->FetchRow()){
    if($row['year'] == $active_year){
        $total_views += $row['views'];
    }
    $data[] = $row;
}

XT::assign("YEARS", $data);
XT::assign("TOTAL_VIEWS", $total_views);

// MONTHS
$month_labels = array(
    1 => 'January',
    2 => 'February',
    3 => 'March',
    4 => 'April',
    5 => 'Mai',
    6 => 'June',
    7 => 'July',
    8 => 'August',
    9 => 'September',
    10 => 'October',
    11 => 'November',
    12 => 'December'
);

XT::assign("MONTH_LABELS", $month_labels);

$result = XT::query("
    SELECT
        *
    FROM 
        " . XT::getTable("months") . "
    WHERE
        year = $active_year
    ORDER BY
        month ASC
",__FILE__,__LINE__);

$months = array();
while($row = $result->FetchRow()){
    $months[$row['month']] = $row;
}
$month_total = array();
for($i = 1; $i <= 12; $i++){
    if(!isset($months[$i])){
        $months[$i] = array('month' => $i,'year' => $active_year,'visitors' => 0,'unique_visitors' => 0,'views' => 0);
    }
    $month_total['views'] += $months[$i]['views'];
    $month_total['visitors'] += $months[$i]['visitors'];
    $month_total['unique_visitors'] += $months[$i]['unique_visitors'];
    
    if($months[$i]['views'] > $month_total['max']){
        $month_total['max'] = $months[$i]['views'];
    }
    if($months[$i]['visitors'] > $month_total['max']){
        $month_total['max'] = $months[$i]['visitors'];
    }
    if($months[$i]['unique_visitors'] > $month_total['max']){
        $month_total['max'] = $months[$i]['unique_visitors'];
    }
}
ksort($months);
XT::assign("MONTHS", $months);
XT::assign("MONTH_TOTAL", $month_total);

// DAYS
$day_labels = array(
    1 => 'Monday',
    2 => 'Tuesday',
    3 => 'Wednesday',
    4 => 'Thursday',
    5 => 'Friday',
    6 => 'Saturday',
    7 => 'Sunday',
);

XT::assign("DAY_LABELS", $day_labels);

$result = XT::query("
    SELECT
        *
    FROM 
        " . XT::getTable("days") . "
    WHERE
        year = $active_year AND
        month = $active_month
    ORDER BY
        day ASC
",__FILE__,__LINE__);

$days = array();
while($row = $result->FetchRow()){
    $days[$row['day']] = $row;
}
$day_total = array();
for($i = 1; $i <= date('t'); $i++){
    if(!isset($days[$i])){
        $days[$i] = array('day' => $i,'month' => $active_month, 'year' => $active_year, 'visitors' => 0,'unique_visitors' => 0,'views' => 0);
    }
    $day_total['views'] += $days[$i]['views'];
    $day_total['visitors'] += $days[$i]['visitors'];
    $day_total['unique_visitors'] += $days[$i]['unique_visitors'];
    
    if($days[$i]['views'] > $day_total['max']){
        $day_total['max'] = $days[$i]['views'];
    }
    if($days[$i]['visitors'] > $day_total['max']){
        $day_total['max'] = $days[$i]['visitors'];
    }
    if($days[$i]['unique_visitors'] > $day_total['max']){
        $day_total['max'] = $days[$i]['unique_visitors'];
    }
}
ksort($days);
XT::assign("DAYS", $days);
XT::assign("DAY_TOTAL", $day_total);

// HOSTS
$result = XT::query("
    SELECT
        *
    FROM 
        " . XT::getTable("hosts_months") . "
    WHERE
        year = $active_year AND
        month = $active_month
    ORDER BY
        views DESC
    LIMIT 20
",__FILE__,__LINE__);

$hosts = array();
$hosts_total = array();
while($row = $result->FetchRow()){
    $row['host'] = gethostbyaddr($row['host']);
    if($row['views'] > $hosts_total['max']){
        $hosts_total['max'] = $row['views'];
    }
    $hosts_total['views'] += $row['views'];
    $hosts[] = $row;
}

XT::assign("HOSTS", $hosts);
XT::assign("HOST_TOTAL", $hosts_total);

// PAGES
$result = XT::query("
    SELECT
        a.views,
        a.visitors,
        a.unique_visitors,
        a.url,
        a.tpl,
        a.year,
        a.month,
        b.title
    FROM 
        " . XT::getTable("views_months") . " as a LEFT JOIN
        " . XT::getTable("navigation_details") . " as b ON (b.node_id = a.tpl AND b.lang = '" . $GLOBALS['lang']->getLang() . "')
    WHERE
        a.year = $active_year AND
        a.month = $active_month AND
        b.title != ''
    GROUP BY
        a.tpl
    ORDER BY
        views DESC
    LIMIT 20
",__FILE__,__LINE__);

$pages = array();
$pages_total = array();
while($row = $result->FetchRow()){
    if($row['views'] > $pages_total['max']){
        $pages_total['max'] = $row['views'];
    }
    if($row['visitors'] > $pages_total['max']){
        $pages_total['max'] = $row['visitors'];
    }
    if($row['unique_visitors'] > $pages_total['max']){
        $pages_total['max'] = $row['unique_visitors'];
    }
    $pages_total['views'] += $row['views'];
    $pages_total['visitors'] += $row['visitors'];
    $pages_total['unique_visitors'] += $row['unique_visitors'];
    $pages[] = $row;
}

XT::assign("PAGES", $pages);
XT::assign("PAGE_TOTAL", $pages_total);

// REFERERS
$result = XT::query("
    SELECT
        *
    FROM 
        " . XT::getTable("referer_months") . "
    WHERE
        year = $active_year AND
        month = $active_month
    ORDER BY
        views DESC
    LIMIT 20
",__FILE__,__LINE__);

$referers = array();
$referers_total = array();
while($row = $result->FetchRow()){
    if($row['views'] > $referers_total['max']){
        $referers_total['max'] = $row['views'];
    }
    if($row['visitors'] > $referers_total['max']){
        $referers_total['max'] = $row['visitors'];
    }
    if($row['unique_visitors'] > $referers_total['max']){
        $referers_total['max'] = $row['unique_visitors'];
    }
    $referers_total['views'] += $row['views'];
    $referers_total['visitors'] += $row['visitors'];
    $referers_total['unique_visitors'] += $row['unique_visitors'];
    $referers[] = $row;
}

XT::assign("REFERERS", $referers);
XT::assign("REFERER_TOTAL", $referers_total);

// BROWSERS
$result = XT::query("
    SELECT
        *
    FROM 
        " . XT::getTable("agents_months") . "
    WHERE
        year = $active_year AND
        month = $active_month
    ORDER BY
        views DESC
    LIMIT 20
",__FILE__,__LINE__);

$agents = array();
$agents_total = array();
while($row = $result->FetchRow()){
    if($row['views'] > $agents_total['max']){
        $agents_total['max'] = $row['views'];
    }
    $agents_total['views'] += $row['views'];
    $agents[] = $row;
}

XT::assign("AGENTS", $agents);
XT::assign("AGENT_TOTAL", $agents_total);

$content = XT::build("overview.tpl");

?>