<?php
$event_id = XT::getValue("id");

if ($event_id == "") {
    $event_id = 0;
}



XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", XT::getPluginLang());

$result = XT::query("
    SELECT
        events.id,
        events.from_date,
        events.end_date,
        events.duration,
        events.duration_type,
        events.country,
        events.region_id,
        events.alt_date,
        events.door,
        events.address,
        events.contact_person_id,
        events.speaker_id,
        events.meeting_place_id,
        events.max_visitors,
        events.reg_visitors,
        (events.max_visitors - events.reg_visitors) as free_places,
        events.costs,
        details.title,
        details.introduction,
        details.maintext,
        details.image,
        details.image_version,
        details.author,
        details.form,
        details.link,
        details.link_external,
        details.registertpl,
        events.display_time_type,
        events.display_time_start,
        events.display_time_end,
        events.set_start_date_only
    FROM
        " . XT::getTable("events") . " as events LEFT JOIN
        " . XT::getTable("events_details") . " as details
        ON(details.id = events.id)
    WHERE
        events.id=" . $event_id . " AND
        details.id=" . $event_id . " AND
        details.lang='" . XT::getPluginLang() . "'
",__FILE__,__LINE__,0);

$row = $result->fetchRow();

if ($row['form'] > 0) {
    $result = XT::query("
       SELECT
           title
       FROM
           " . XT::getTable("forms") . "
       WHERE
            id=" . $row['form'] . "
    ",__FILE__,__LINE__);
    $row_form = $result->fetchRow();
    $row['form_title'] = $row_form['title'];
}

$from_date = $row['from_date'];
$days_in_month = date("t", $from_date);

$hours = array();

for($i = 0; $i < 24; $i++) {
    array_push($hours, $i);
}

$days = array();

for($i = 1; $i < ($days_in_month + 1); $i++) {
    array_push($days, $i);
}

$months = array();

for($i = 1; $i < 13; $i++) {
    array_push($months, $i);
}

$years = array();

for($i = (date("Y", time()) - 10); $i < 2031; $i++) {
    array_push($years, $i);
}


// timer
$time['type']=$row['display_time_type'];

for ($i=0;$i<24;$i++){
    if($i == date('H',$row['display_time_start'])){
        $time['shour'][$i]=true;
    }else{
        $time['shour'][$i]=false;
    }
    if($i == date('H',$row['display_time_end'])){
        $time['ehour'][$i]=true;
    }else{
        $time['ehour'][$i]=false;
    }
}

for ($i=0;$i<60;$i= $i+5){
    if($i == intval(date('i',$row['display_time_start']))){
        $time['smin'][$i]=true;
    }else{
        $time['smin'][$i]=false;
    }
    if($i == intval(date('i',$row['display_time_end']))){
        $time['emin'][$i]=true;
    }else{
        $time['emin'][$i]=false;
    }
}

switch ($row['display_time_type']) {
    case 0:
        $time['sdate']=0;
        $time['sdate_str']=0;
        $time['edate']=0;
        $time['edate_str']=0;
        break;
    case 1:
        $time['sdate']= $row['display_time_start'] > 0 ? $row['display_time_start'] : time();
        $time['sdate_str']=$row['display_time_start'] > 0 ? date('d.m.Y',$row['display_time_start']) : date('d.m.Y', time());
        $time['edate']=0;
        $time['edate_str']=0;
        break;
    case 2:
        $time['sdate']= 0;
        $time['sdate_str']=0;
        $time['edate']= $row['display_time_end'] > 0 ? $row['display_time_end'] : time();
        $time['edate_str']=$row['display_time_end'] > 0 ? date('d.m.Y',$row['display_time_end']) : date('d.m.Y', (time() + 86400));
        break;
    case 3:
        $time['sdate']= $row['display_time_start'] > 0 ? $row['display_time_start'] : time();
        $time['sdate_str']=$row['display_time_start'] > 0 ? date('d.m.Y',$row['display_time_start']) : date('d.m.Y', time());
        $time['edate']= $row['display_time_end'] > 0 ? $row['display_time_end'] : time();
        $time['edate_str']=$row['display_time_end'] > 0 ? date('d.m.Y',$row['display_time_end']) : date('d.m.Y', (time() + 86400));
        break;
    default:
        $time['sdate']= $row['display_time_start'] > 0 ? $row['display_time_start'] : time();
        $time['sdate_str']=$row['display_time_start'] > 0 ? date('d.m.Y',$row['display_time_start']) : date('d.m.Y', time());
        $time['edate']= $row['display_time_end'] > 0 ? $row['display_time_end'] : time();
        $time['edate_str']=$row['display_time_end'] > 0 ? date('d.m.Y',$row['display_time_end']) : date('d.m.Y', (time() + 86400));

        break;
}


XT::assign('TIME',$time);
XT::assign('DATE_PICKER_TPL',305);
// <-timer




$address_id = is_numeric($row['address']) ? $row['address'] : 0;
$result = XT::query("
    SELECT
        id,
        title,
        street,
        postalCode,
        city
    FROM
        " . XT::getTable("addresses") . "
    WHERE
        id=" . $address_id
,__FILE__,__LINE__);

XT::assign("ADDRESS", $result->fetchRow());

$contact_person_id = is_numeric($row['contact_person_id']) ? $row['contact_person_id'] : 0;
$result = XT::query("
    SELECT
        id,
        title,
        street,
        postalCode,
        city
    FROM
        " . XT::getTable("addresses") . "
    WHERE
        id=" . $contact_person_id
,__FILE__,__LINE__);

XT::assign("CONTACT_PERSON", $result->fetchRow());

$speaker_id = is_numeric($row['speaker_id']) ? $row['speaker_id'] : 0;
$result = XT::query("
    SELECT
        id,
        title,
        street,
        postalCode,
        city
    FROM
        " . XT::getTable("addresses") . "
    WHERE
        id=" . $speaker_id
,__FILE__,__LINE__);

XT::assign("SPEAKER", $result->fetchRow());

$meeting_place_id = is_numeric($row['meeting_place_id']) ? $row['meeting_place_id'] : 0;
$result = XT::query("
    SELECT
        id,
        title,
        street,
        postalCode,
        city
    FROM
        " . XT::getTable("addresses") . "
    WHERE
        id=" . $meeting_place_id
,__FILE__,__LINE__);

XT::assign("MEETINGPLACE", $result->fetchRow());


// Get countries
$result = XT::query("
    SELECT
        country,
        name
    FROM
        " . XT::getTable('countries') . "
    ORDER BY
        name ASC
",__FILE__,__LINE__);

XT::assign("COUNTRIES",XT::getQueryData($result));

// Get regions
$result = XT::query("
    SELECT
        region,
        name
    FROM
        " . XT::getTable('countries_regions') . "
    WHERE
        country = '" . $row['country'] . "'
    ORDER BY
        name ASC
",__FILE__,__LINE__);

XT::assign("REGIONS",XT::getQueryData($result));

// Get Registration Templates
$registertpls = array();

// $registertpl = TEMPLATE_DIR . $_SESSION['theme'] . '/ch.iframe.snode.events/registration/default.tpl'
// $registertpl = substr($registertpl, strrpos($registertpl, "/")+1)
// echo $registertpl;
// default.tpl

// Get all themed Templates
$themed_templates = glob(TEMPLATE_DIR . $_SESSION['theme'] . '/ch.iframe.snode.events/registration/*.tpl');
if(is_array($themed_templates)) {
    foreach ($themed_templates as $registertpl){
        $registertpls[$_SESSION['theme']][substr($registertpl, strrpos($registertpl, "/")+1)]  = substr($registertpl, strrpos($registertpl, "/")+1);
    }
}

// Get all default templates who got diffrent names
foreach (glob(TEMPLATE_DIR . '/default/ch.iframe.snode.events/registration/*.tpl') as $registertpl){
    if(count($registertpls) > 0) {
        if(!array_key_exists(substr($registertpl, strrpos($registertpl, "/")+1), $registertpls[$_SESSION['theme']])) {
            $registertpls["default"][substr($registertpl, strrpos($registertpl, "/")+1)]  = substr($registertpl, strrpos($registertpl, "/")+1);
        }
    }
    else {
        $registertpls["default"][substr($registertpl, strrpos($registertpl, "/")+1)]  = substr($registertpl, strrpos($registertpl, "/")+1);
    }
}

XT::assign("REGISTERTPLS",  $registertpls);

XT::assign("HOURS",  $hours);
XT::assign("HOUR_SELECTED", date("H", $from_date));

XT::assign("DAYS",   $days);
XT::assign("DAY_SELECTED", date("d", $from_date));

XT::assign("MONTHS", $months);
XT::assign("MONTH_SELECTED", date("m", $from_date));

XT::assign("YEARS",  $years);
XT::assign("YEAR_SELECTED", date("Y", $from_date));

// Images
XT::assign("IMAGE_PICKER_TPL", XT::getConfig("image_picker_tpl"));
XT::assign("IMAGE_PICKER_BASE_ID", XT::getConfig("image_picker_base_id"));

// Forms
XT::assign("FORM_PICKER_TPL", XT::getConfig("form_picker_tpl"));
XT::assign("FORM_PICKER_BASE_ID", XT::getConfig("form_picker_base_id"));

// Address
XT::assign("ADDR_PICKER_TPL", XT::getConfig("ADDR_PICKER_TPL"));

// Date
XT::assign("DATE_PICKER_TPL", XT::getConfig("DATE_PICKER_TPL"));

XT::assign("ID", $event_id);

XT::assign("EVENT", $row);
$content = XT::build("edit_event.tpl");
?>