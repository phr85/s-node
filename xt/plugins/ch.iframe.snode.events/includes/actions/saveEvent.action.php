<?php
XT::setAdminModule("e");

$event_id = XT::getValue("id");
$lang = XT::getValue("save_lang") == "" ? XT::getPluginLang() : XT::getValue("save_lang");

if ($event_id == "") {
	$event_id = 0;
}

$from_date = mktime(XT::getValue('start_hour'), XT::getValue('start_min'), 1, XT::getValue('month'), XT::getValue('day'), XT::getValue('year'));

switch (XT::getValue("duration_type")) {
    case "week":
        $end_date = $from_date + (intval(XT::getValue("duration")) * 604799);
        break;
    case "day":
        $end_date = $from_date + (intval(XT::getValue("duration")) * 86399);
        break;
    case "hours":
        $end_date = $from_date + (intval(XT::getValue("duration")) * 3600);
        break;
    default:
        $end_date = $from_date + (intval(XT::getValue("duration")) * 60);
        break;
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
            image='" . XT::getValue("image") . "',
            image_version='" . XT::getValue("image_version") . "',
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
        from_date='" . $from_date . "',
        end_date='" . $end_date . "',
        duration='" . XT::getValue('duration') . "',
        duration_type='" . XT::getValue('duration_type') . "',
        country='" . XT::getValue("country") . "',
        region_id='" . XT::getValue("region_id") . "',
        address='" . XT::getValue("address") . "',
        contact_person_id='" . XT::getValue("contact_person_id") . "',
        speaker_id='" . XT::getValue("speaker_id") . "',
        meeting_place_id='" . XT::getValue("meeting_place_id") . "',
        country='" . XT::getValue("country") . "',
        region_id='" . XT::getValue("region_id") . "',
        max_visitors='" . XT::getValue("max_visitors") . "',
        costs='" . XT::getValue("costs") . "',
        display_time_type ='" . XT::getValue('time_type') . "',
        display_time_start ='" . XT::getValue('sdate') . "',
        display_time_end ='" . XT::getValue('edate') . "',
        set_start_date_only = '" . XT::getValue('set_start_date_only') . "'
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
        image='" . XT::getValue("image") . "',
        image_version='" . XT::getValue("image_version") . "',
        form='" . XT::getValue("form") . "',
        link='" . XT::getValue("link") . "',
        link_external='" . XT::getValue("link_external") . "',
        registertpl='" . XT::getValue("registertpl") . "'
    WHERE
        id=" . $event_id . " AND
        lang='" . $lang . "'
",__FILE__,__LINE__);



// Instantiate indexing object and index main fields
XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
$search = new XT_SearchIndex($event_id,5100,1);
$search->setLang($lang);
$search->setTime(intval(XT::getValue('sdate')),intval(XT::getValue('edate')));
$search->setManualDate($from_date);

$search->add(addslashes(XT::getValue("maintext")), 2);
$searchimage = XT::getValue("image") != "" ? XT::getValue("image") : 0;

$search->build(XT::getValue("title"), addslashes(XT::getValue("introduction")),$searchimage);

?>