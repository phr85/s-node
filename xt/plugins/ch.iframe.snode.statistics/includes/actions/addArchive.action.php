<?php

set_time_limit(0);
$deldate = 0; 

$result = XT::query("
    SELECT end_date FROM " . $GLOBALS['plugin']->getTable("tracking_archives") . " ORDER BY end_date DESC LIMIT 1
",__FILE__,__LINE__);

$stats_data = XT::getQueryData($result);
$end_date = $stats_data[0]['end_date'];
if($end_date == 0){
    $end_date = TIME;
}

// Insert new archive entry
XT::query("
    INSERT INTO " . $GLOBALS['plugin']->getTable("tracking_archives") . "
    (
        start_date,
        end_date
    ) VALUES (
        " . ($end_date + 1) . ",
        " . TIME . "
    )
",__FILE__,__LINE__);

$result = XT::query("
    SELECT * FROM " . XT::getTable("tracking") . " ORDER BY call_time ASC LIMIT 5000
",__FILE__,__LINE__);

// Search engines
$engines = array(
"Inktomi Search" => "inktomisearch.com",
"MSN Search" => "msnbot.msn.com",
"Search.ch" => "spider.search.ch",
);

// Statistics :: Prepare :: Year
$year = array();

// Statistics :: Prepare :: Months
$months = array();

// Statistics :: Prepare :: Days
$days = array();

// Statistics :: Prepare :: Hosts
$hosts_month = array();

// Statistics :: Prepare :: Referer
$referer_month = array();

// Statistics :: Prepare :: Page Views
$views_month = array();

// Statistics :: Prepare :: Agents
$agents_month = array();
$agent_views = array();

while($row = $result->FetchRow()){
    $date = getdate($row['call_time']);

    // Statistics :: Process :: Year
    $year[$date['year']]['views']++;
    if(!isset($year[$date['year']]['sessions'][$row['session_id']])){
        $year[$date['year']]['visitors']++;
        $year[$date['year']]['sessions'][$row['session_id']] = true;
        if(!isset($year[$date['year']]['addr'][$row['addr']])){
            $year[$date['year']]['unique_visitors']++;
            $year[$date['year']]['addr'][$row['addr']] = true;
        }
    }

    // Statistics :: Process :: Months
    $months[$date['year']][$date['mon']]['views']++;
    if(!isset($months[$date['year']][$date['mon']]['sessions'][$row['session_id']])){
        $months[$date['year']][$date['mon']]['visitors']++;
        $months[$date['year']][$date['mon']]['sessions'][$row['session_id']] = true;
        if(!isset($months[$date['year']][$date['mon']]['addr'][$row['addr']])){
            $months[$date['year']][$date['mon']]['unique_visitors']++;
            $months[$date['year']][$date['mon']]['addr'][$row['addr']] = true;
        }
    }

    // Statistics :: Process :: Days
    $days[$date['year']][$date['mon']][$date['mday']]['views']++;
    if(!isset($days[$date['year']][$date['mon']][$date['mday']]['sessions'][$row['session_id']])){
        $days[$date['year']][$date['mon']][$date['mday']]['visitors']++;
        $days[$date['year']][$date['mon']][$date['mday']]['sessions'][$row['session_id']] = true;
        if(!isset($days[$date['year']][$date['mon']][$date['mday']]['addr'][$row['addr']])){
            $days[$date['year']][$date['mon']][$date['mday']]['unique_visitors']++;
            $days[$date['year']][$date['mon']][$date['mday']]['addr'][$row['addr']] = true;
        }
    }

    // Statistics :: Process :: Hosts
    $host = $row['addr'];
    $hosts_month[$date['year']][$date['mon']][$host]['views']++;
    if($row['call_time'] > $hosts_month[$date['year']][$date['mon']][$host]['call_time']){
        $hosts_month[$date['year']][$date['mon']][$host]['call_time'] = $row['call_time'];
    }

    if($row['referer'] != '' && !strpos($row['referer'],$_SERVER['HTTP_HOST'])){
        // Statistics :: Process :: Referer
        $referer_month[$date['year']][$date['mon']][$row['referer']]['views']++;
        if(!isset($referer_month[$date['year']][$date['mon']][$row['referer']]['sessions'][$row['session_id']])){
            $referer_month[$date['year']][$date['mon']][$row['referer']]['visitors']++;
            $referer_month[$date['year']][$date['mon']][$row['referer']]['sessions'][$row['session_id']] = true;
            if(!isset($referer_month[$date['year']][$date['mon']][$row['referer']]['addr'][$row['addr']])){
                $referer_month[$date['year']][$date['mon']][$row['referer']]['unique_visitors']++;
                $referer_month[$date['year']][$date['mon']][$row['referer']]['addr'][$row['addr']] = true;
            }
        }
    }

    // Statistics :: Process :: Views
    $views_month[$date['year']][$date['mon']][$row['uri']]['views']++;
    $views_month[$date['year']][$date['mon']][$row['uri']]['tpl'] = $row['tpl'];
    if(!isset($views_month[$date['year']][$date['mon']][$row['uri']]['sessions'][$row['session_id']])){
        $views_month[$date['year']][$date['mon']][$row['uri']]['visitors']++;
        $views_month[$date['year']][$date['mon']][$row['uri']]['sessions'][$row['session_id']] = true;
        if(!isset($views_month[$date['year']][$date['mon']][$row['uri']]['addr'][$row['addr']])){
            $views_month[$date['year']][$date['mon']][$row['uri']]['unique_visitors']++;
            $views_month[$date['year']][$date['mon']][$row['uri']]['addr'][$row['addr']] = true;
        }
    }

    // Statistics :: Process :: Agents
    $agent_views[$date['year']][$date['mon']]++;
    if(!isset($views_month[$date['year']][$date['mon']][$row['agent']]['sessions'][$row['session_id']])){
        $agents_month[$date['year']][$date['mon']][$row['agent']]['sessions'][$row['session_id']] = true;
        $agents_month[$date['year']][$date['mon']][$row['agent']]['views']++;
    }


    $deldate = $row['call_time'];
}

$result = XT::query("
    DELETE FROM " . $GLOBALS['plugin']->getTable("tracking") . " WHERE call_time < " . $deldate . "
",__FILE__,__LINE__);

// Statistics :: Insert :: Year
while (list($key, $year_data) = each($year)){
    $result = XT::query("
        SELECT year FROM " . XT::getTable("years") . " WHERE year = " . $key . " LIMIT 1
    ",__FILE__,__LINE__);

    // If year entry doesn't exist yet, create it
    if($result->RecordCount() == 0){
        $result = XT::query("
            INSERT INTO 
                " . XT::getTable("years") . " 
            (
                year,
                views,
                visitors,
                unique_visitors
            ) VALUES (
                " . $key . ",
                " . $year_data['views'] . ",
                " . $year_data['visitors'] . ",
                " . $year_data['unique_visitors'] . "
            )
        ",__FILE__,__LINE__);
    } else {
        // else, update dataset
        $result = XT::query("
            UPDATE
                " . XT::getTable("years") . " 
            SET 
                views = views + " . $year_data['views'] . ",
                visitors = visitors + " . $year_data['visitors'] . ",
                unique_visitors = unique_visitors + " . $year_data['unique_visitors'] . "
            WHERE
                year = " . $key . "
        ",__FILE__,__LINE__);
    }

    // Statistics :: Insert :: Months
    while (list($month, $month_data) = each($months[$key])){
        $result = XT::query("
            SELECT month FROM " . XT::getTable("months") . " WHERE year = " . $key . " AND month = " . $month . " LIMIT 1
        ",__FILE__,__LINE__);

        // If month entry doesn't exist yet, create it
        if($result->RecordCount() == 0){
            $result = XT::query("
                INSERT INTO 
                    " . XT::getTable("months") . " 
                (
                    year,
                    month,
                    views,
                    visitors,
                    unique_visitors
                ) VALUES (
                    " . $key . ",
                    " . $month . ",
                    " . $month_data['views'] . ",
                    " . $month_data['visitors'] . ",
                    " . $month_data['unique_visitors'] . "
                )
            ",__FILE__,__LINE__);
        } else {
            // else, update dataset
            $result = XT::query("
                UPDATE
                    " . XT::getTable("months") . " 
                SET 
                    views = views + " . $month_data['views'] . ",
                    visitors = visitors + " . $month_data['visitors'] . ",
                    unique_visitors = unique_visitors + " . $month_data['unique_visitors'] . "
                WHERE
                    year = " . $key . " AND
                    month = " . $month . "
            ",__FILE__,__LINE__);
        }

        // Statistics :: Insert :: Days
        while (list($day, $day_data) = each($days[$key][$month])){
            $result = XT::query("
                SELECT month FROM " . XT::getTable("days") . " WHERE year = " . $key . " AND month = " . $month . " AND day = " . $day . " LIMIT 1
            ",__FILE__,__LINE__);

            // If day entry doesn't exist yet, create it
            if($result->RecordCount() == 0){
                $result = XT::query("
                    INSERT INTO 
                        " . XT::getTable("days") . " 
                    (
                        year,
                        month,
                        day,
                        views,
                        visitors,
                        unique_visitors
                    ) VALUES (
                        " . $key . ",
                        " . $month . ",
                        " . $day . ",
                        " . $day_data['views'] . ",
                        " . $day_data['visitors'] . ",
                        " . $day_data['unique_visitors'] . "
                    )
                ",__FILE__,__LINE__);
            } else {
                // else, update dataset
                $result = XT::query("
                    UPDATE
                        " . XT::getTable("days") . " 
                    SET 
                        views = views + " . $day_data['views'] . ",
                        visitors = visitors + " . $day_data['visitors'] . ",
                        unique_visitors = unique_visitors + " . $day_data['unique_visitors'] . "
                    WHERE
                        year = " . $key . " AND
                        month = " . $month . " AND
                        day = " . $day . "
                ",__FILE__,__LINE__);
            }
        }

        // Statistics :: Insert :: Hosts
        while (list($host, $host_data) = each($hosts_month[$key][$month])){

            // Filter search engines
            if($host_data['host'] == ''){

            }

            $result = XT::query("
                SELECT month FROM " . XT::getTable("hosts_months") . " WHERE year = " . $key . " AND month = " . $month . " AND host = '" . $host . "' LIMIT 1
            ",__FILE__,__LINE__);

            // If day entry doesn't exist yet, create it
            if($result->RecordCount() == 0){
                $result = XT::query("
                    INSERT INTO 
                        " . XT::getTable("hosts_months") . " 
                    (
                        year,
                        month,
                        host,
                        views,
                        last_access
                    ) VALUES (
                        " . $key . ",
                        " . $month . ",
                        '" . $host . "',
                        " . $host_data['views'] . ",
                        " . $host_data['call_time'] . "
                    )
                ",__FILE__,__LINE__);
            } else {
                // else, update dataset
                $result = XT::query("
                    UPDATE
                        " . XT::getTable("hosts_months") . " 
                    SET 
                        views = views + " . $host_data['views'] . ",
                        last_access = " . $host_data['call_time'] . "
                    WHERE
                        year = " . $key . " AND
                        month = " . $month . " AND
                        host = '" . $host . "'
                ",__FILE__,__LINE__);
            }
        }

        // Statistics :: Insert :: Referer
        if(is_array($referer_month[$key][$month])){
            while (list($referer, $referer_data) = each($referer_month[$key][$month])){

                // Filter search engines
                if($host_data['host'] == ''){

                }

                $result = XT::query("
                    SELECT month FROM " . XT::getTable("referer_months") . " WHERE year = " . $key . " AND month = " . $month . " AND referer = '" . addslashes($referer) . "' LIMIT 1                ",__FILE__,__LINE__);

                // If day entry doesn't exist yet, create it
                if($result->RecordCount() == 0){
                    $result = XT::query("
                        INSERT INTO 
                            " . XT::getTable("referer_months") . " 
                        (
                            year,
                            month,
                            referer,
                            views,
                            visitors,
                            unique_visitors
                        ) VALUES (
                            " . $key . ",
                            " . $month . ",
                            '" . $referer . "',
                            " . $referer_data['views'] . ",
                            " . $referer_data['visitors'] . ",
                            " . $referer_data['unique_visitors'] . "
                        )
                    ",__FILE__,__LINE__);
                } else {
                    // else, update dataset
                    $result = XT::query("
                        UPDATE
                            " . XT::getTable("referer_months") . " 
                        SET 
                            views = views + " . $referer_data['views'] . ",
                            visitors = visitors + " . $referer_data['visitors'] . ",
                            unique_visitors = unique_visitors + " . $referer_data['unique_visitors'] . "
                        WHERE
                            year = " . $key . " AND
                            month = " . $month . " AND
                            referer = '" . $referer . "'
                    ",__FILE__,__LINE__);
                }
            }
        }

        // Statistics :: Insert :: views
        while (list($url, $views_data) = each($views_month[$key][$month])){

            // Filter search engines
            if($host_data['host'] == ''){

            }

            $result = XT::query("
                SELECT month FROM " . XT::getTable("views_months") . " WHERE year = " . $key . " AND month = " . $month . " AND url = '" . addslashes($url) . "' LIMIT 1
            ",__FILE__,__LINE__);

            // If day entry doesn't exist yet, create it
            if($result->RecordCount() == 0){
                $result = XT::query("
                    INSERT INTO 
                        " . XT::getTable("views_months") . " 
                    (
                        year,
                        month,
                        url,
                        tpl,
                        views,
                        visitors,
                        unique_visitors
                    ) VALUES (
                        " . $key . ",
                        " . $month . ",
                        '" . addslashes($url) . "',
                        " . $views_data['tpl'] . ",
                        " . $views_data['views'] . ",
                        " . $views_data['visitors'] . ",
                        " . $views_data['unique_visitors'] . "
                    )
                ",__FILE__,__LINE__);
            } else {
                // else, update dataset
                $result = XT::query("
                    UPDATE
                        " . XT::getTable("views_months") . " 
                    SET 
                        views = views + " . $views_data['views'] . ",
                        visitors = visitors + " . $views_data['visitors'] . ",
                        unique_visitors = unique_visitors + " . $views_data['unique_visitors'] . "
                    WHERE
                        year = " . $key . " AND
                        month = " . $month . " AND
                        url = '" . $url . "'
                ",__FILE__,__LINE__);
            }
        }

        // Statistics :: Insert :: Agents
        while (list($agent, $agents_data) = each($agents_month[$key][$month])){

            if(strstr($agent, 'Mozilla')){
                $agent_type = "Mozilla";
                if(strstr($agent, 'MSIE')){
                    $agent_type = "Internet Explorer";
                }
                if(strstr($agent, 'Firefox')){
                    $agent_type = "Firefox";
                }
            } else {
                $agent_type = "Other";
            }
            if(strstr($agent, 'Safari')){ $agent_type = 'Safari'; }
            if(strstr($agent, 'Opera')){ $agent_type = 'Opera'; }
            if(strstr($agent, 'AOL')){ $agent_type = 'AOL'; }

            // Search bots
            if(strstr($agent, 'thesubot')){ $agent_type = 'Bot: TheSuBot'; }
            if(strstr($agent, 'GigaBot')){ $agent_type = 'Bot: GigaBot'; }
            if(strstr($agent, 'Google')){ $agent_type = 'Bot: GoogleBot'; }
            if(strstr($agent, 'Yahoo')){ $agent_type = 'Bot: Yahoo!'; }
            if(strstr($agent, 'search.ch')){ $agent_type = 'Bot: search.ch'; }
            if(strstr($agent, 'msnbot')){ $agent_type = 'Bot: MSN'; }
            if(strstr($agent, 'aipbot')){ $agent_type = 'Bot: aipbot'; }

            $result = XT::query("
                SELECT month FROM " . XT::getTable("agents_months") . " WHERE year = " . $key . " AND month = " . $month . " AND agent = '" . $agent_type . "' LIMIT 1
            ",__FILE__,__LINE__);

            // If day entry doesn't exist yet, create it
            if($result->RecordCount() == 0){
                $result = XT::query("
                    INSERT INTO 
                        " . XT::getTable("agents_months") . " 
                    (
                        year,
                        month,
                        agent,
                        views
                    ) VALUES (
                        " . $key . ",
                        " . $month . ",
                        '" . $agent_type . "',
                        " . $agents_data['views'] . "
                    )
                ",__FILE__,__LINE__);
            } else {
                // else, update dataset
                $result = XT::query("
                    UPDATE
                        " . XT::getTable("agents_months") . " 
                    SET 
                        views = views + " . $agents_data['views'] . "
                    WHERE
                        year = " . $key . " AND
                        month = " . $month . " AND
                        agent = '" . $agent_type . "'
                ",__FILE__,__LINE__);
            }
        }
    }
}

$result = XT::query("SELECT count(*) as cnt FROM " . XT::getTable("tracking") ,__FILE__,__LINE__);
$data = XT::getQueryData($result);
 
 
if ($data[0]['cnt'] > 500){
    header("Location: " . $SERVER . "/index.php?TPL=155&x2600_action=addArchive");
}
 
/*
// Get start date
$result = XT::query("
SELECT end_date FROM " . $GLOBALS['plugin']->getTable("tracking_archives") . " ORDER BY end_date DESC LIMIT 1
",__FILE__,__LINE__);

$data = XT::getQueryData($result);
$end_date = $data[0]['end_date'];

$result = XT::query("
SELECT * FROM " . $GLOBALS['plugin']->getTable("tracking") . " ORDER BY session_id
",__FILE__,__LINE__);

// Statistics :: Year data
$year = array();

$data = array();
while($row = $result->FetchRow()){

$date = getdate($row['call_date']);
print_r($date);
$year[$date['y']];

$data[] = $row;
}


*/
/*
$result = XT::query("
DELETE FROM " . $GLOBALS['plugin']->getTable("tracking") . "
",__FILE__,__LINE__);

$file = fopen(DATA_DIR . "stats/" . ($end_date + 1) . "_" . TIME . ".snodestats","w+");
$serialized = serialize($data);
fwrite($file, $serialized);
fclose($file);

// Insert new archive entry
XT::query("
INSERT INTO " . $GLOBALS['plugin']->getTable("tracking_archives") . "
(
start_date,
end_date
) VALUES (
" . ($end_date + 1) . ",
" . TIME . "
)
",__FILE__,__LINE__);
*/

?>