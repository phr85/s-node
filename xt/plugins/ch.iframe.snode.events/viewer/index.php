<?php
/**
 * Param :: event_id
 */
$event_id = XT::getParam("event_id") == "" ? 0 : XT::getParam("event_id");

/**
 * Param :: style
 */
$style = XT::getParam("style") == "" ? "default.tpl" : XT::getParam("style");

if ($event_id == 0) {
    $event_id = XT::getValue("event_id") != "" ? XT::getValue("event_id") : 0;
}

$result = XT::query("
    SELECT
        events.id,
        events.from_date,
        events.end_date,
        events.duration,
        events.duration_type,
        events.address,
        events.reg_visitors,
        events.max_visitors,
        events.max_visitors-events.reg_visitors as free_visitors,
        events.contact_person_id,
        events.speaker_id,
        events.meeting_place_id,
        events.costs,
        events.display_time_start,
        events.display_time_end,
        events.set_start_date_only,
        details.title,
        details.introduction,
        details.maintext,
        details.image,
        details.image_version,
        details.author,
        details.form,
        details.link,
        details.link_external,
        details.registertpl
    FROM
        " . XT::getTable("events") . " as events LEFT JOIN
        " . XT::getTable("events_details") . " as details
        ON(details.id = events.id)
    WHERE
        events.id=" . $event_id . " AND
        details.id=" . $event_id . " AND
        details.lang='" . XT::getLang() . "' AND
        details.active=1
    AND
        (events.display_time_start = 0 OR events.display_time_start < " . time() . ")
    AND
        (events.display_time_end = 0 OR events.display_time_end > " . time() . ")"
,__FILE__,__LINE__);

$row = $result->fetchRow();
XT::addToTitle($row['title']);
XT::assign("EVENT", $row);

$content = XT::build($style);
?>