<?php

$event_id = XT::getValue("id");
$lang = XT::getValue("save_lang") == "" ? XT::getPluginLang() : XT::getValue("save_lang");

if ($event_id == "") {
	$event_id = 0;
}

$from_date = mktime(XT::getValue('start_hour'), XT::getValue('start_min'), 0, XT::getValue('month'), XT::getValue('day'), XT::getValue('year'));

if(XT::getValue("duration_type") != "minutes") {
    $end_date = strtotime("+" . XT::getValue("duration") . " " . XT::getValue("duration_type"), $from_date);
}
else {
    $duration = XT::getValue("duration");
    
    settype($duration, 'integer');
    $end_date = $from_date + ($duration * 60);
}

if (XT::getValue("allow_registration") == "") {
	XT::setValue("form", 0);
}

if (XT::getValue("haslink") == "") {
	XT::setValue("link", "");
}

if (XT::getValue("link_external") != "") {
	XT::setValue("link_external", 1);
} else {
	XT::setValue("link_external", 0);
}

if (XT::getValue("delete_image") == 1) {
	XT::setValue("image", 0);
}

$result = XT::query("
    SELECT COUNT(id) as cnt FROM
        " . XT::getTable("events_details") . "
    WHERE 
       id=" . $event_id . " AND
       lang='" . XT::getPluginLang() . "'
",__FILE__,__LINE__);

$row = $result->fetchRow();

if ($row['cnt'] == 0) {
	XT::query("
	   INSERT INTO 
	       " . XT::getTable("events_details") . "
       (
            id, 
            lang, 
            creation_date, 
            creation_user
       ) VALUES (
            " . $event_id . ",
            '" . XT::getPluginLang() . "',
            " . time() . ",
            " . XT::getUserID() . "
       )
	",__FILE__,__LINE__);
	
	XT::query("
        UPDATE
            " . XT::getTable("events_details") . "
        SET 
            title='" . XT::getValue("title") . "',
            introduction='" . XT::getValue("introduction") . "',
            maintext='" . XT::getValue("maintext") . "',
            mod_date=" . time() . ",
            mod_user=" . XT::getUserID() . ",
            author='" . XT::getValue("author") . "',
            form='" . XT::getValue("form") . "',
            link='" . XT::getValue("link") . "',
            link_external='" . XT::getValue("link_external") . "'
        WHERE
            id=" . $event_id . " AND
            lang='" . XT::getPluginLang() . "'
    ",__FILE__,__LINE__);
	
}

// timer
$sdate = XT::getValue('sdate');
if($sdate > 0){
    XT::setValue('sdate',mktime(XT::getValue('hstart') ,XT::getValue('mstart'),0,date('m',$sdate),date('d',$sdate),date('y',$sdate)));
}
$edate = XT::getValue('edate');
if ($edate > 0){
    XT::setValue('edate',mktime(XT::getValue('hend') ,XT::getValue('mend'),0,date('m',$edate),date('d',$edate),date('y',$edate)));
}
if(XT::getValue('time_type') == 0){
     XT::setValue('edate',0);
     XT::setValue('sdate',0);
}
XT::query("
    UPDATE
        " . XT::getTable("events") . "
    SET
        from_date=" . $from_date . ",
        end_date=" . $end_date . ",
        duration='" . XT::getValue('duration') . "',
        duration_type='" . XT::getValue('duration_type') . "',
        address='" . XT::getValue("address") . "',
        contact_person_id='" . XT::getValue("contact_person_id") . "',
        country='" . XT::getValue("country") . "',
        region_id='" . XT::getValue("region_id") . "',
        max_visitors='" . XT::getValue("max_visitors") . "',
        costs='" . XT::getValue("costs") . "',
        display_time_type ='" . XT::getValue('time_type') . "',
        display_time_start ='" . XT::getValue('sdate') . "',
        display_time_end ='" . XT::getValue('edate') . "'
 
    WHERE
        id=" . $event_id
,__FILE__,__LINE__);

XT::query("
    UPDATE
        " . XT::getTable("events_details") . "
    SET 
        title='" . XT::getValue("title") . "',
        introduction='" . XT::getValue("introduction") . "',
        maintext='" . XT::getValue("maintext") . "',
        mod_date=" . time() . ",
        mod_user=" . XT::getUserID() . ",
        author='" . XT::getValue("author") . "',
        form='" . XT::getValue("form") . "',
        link='" . XT::getValue("link") . "',
        link_external='" . XT::getValue("link_external") . "'
    WHERE
        id=" . $event_id . " AND
        lang='" . $lang . "'
",__FILE__,__LINE__);

XT::query("
    UPDATE
        " . XT::getTable("events_tree_rel") . "
    SET 
        node_id=" . XT::getValue("cat") . "
    WHERE
        event_id=" . $event_id . "
",__FILE__,__LINE__);

?>