<?php

if($GLOBALS['plugin']->getValue("title") == ''){
    XT::log("Please fill in a project title",__FILE__,__LINE__,XT_ERROR);
}

if($GLOBALS['plugin']->getValue("budget_end") < $GLOBALS['plugin']->getValue("budget_start")){
    XT::log("Bugdet upper value cannot be smaller than the Budget start value",__FILE__,__LINE__,XT_ERROR);
}

if(!XT::hasErrors()){

    // Build start timestamp
    $minute = $GLOBALS['plugin']->getValue("start_time_minute");
    $hour = $GLOBALS['plugin']->getValue("start_time_hour");
    $day = $GLOBALS['plugin']->getValue("start_date_day");
    $month = $GLOBALS['plugin']->getValue("start_date_month");
    $year = $GLOBALS['plugin']->getValue("start_date_year");
    $start_date = mktime($hour,$minute,0,$month,$day,$year);

    // Build deadline timestamp
    $minute = $GLOBALS['plugin']->getValue("end_time_minute");
    $hour = $GLOBALS['plugin']->getValue("end_time_hour");
    $day = $GLOBALS['plugin']->getValue("end_date_day");
    $month = $GLOBALS['plugin']->getValue("end_date_month");
    $year = $GLOBALS['plugin']->getValue("end_date_year");
    $end_date = mktime($hour,$minute,0,$month,$day,$year);

    XT::query("
        UPDATE
            " . $GLOBALS['plugin']->getTable("projects") . "
        SET
            title = '" . $GLOBALS['plugin']->getValue("title") . "',
            description = '" . $GLOBALS['plugin']->getValue("description") . "',
            customer_id = '" . $GLOBALS['plugin']->getValue("customer_id") . "',
            customer_contact_id = '" . $GLOBALS['plugin']->getValue("customer_contact_id") . "',
            lead_id = '" . $GLOBALS['plugin']->getValue("lead_id") . "',
            accounting_type = '" . $GLOBALS['plugin']->getValue("accounting_type") . "',
            accounting_value = '" . $GLOBALS['plugin']->getValue("accounting_value") . "',
            end_date = " . $end_date . ",
            start_date = " . $start_date . ",
            status = 0,
            budget_start = '" . $GLOBALS['plugin']->getValue("budget_start") . "',
            budget_end = '" . $GLOBALS['plugin']->getValue("budget_end") . "',
            mod_date = " . time() . ",
            mod_user = " . XT::getUserID() . "
        WHERE
            id = " . $GLOBALS['plugin']->getSessionValue("project_id") . "
        ",__FILE__,__LINE__);
        
    XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
    $search = new XT_SearchIndex($GLOBALS['plugin']->getSessionValue("project_id"),$GLOBALS['plugin']->getContentType("Project"));
    $search->add($GLOBALS['plugin']->getValue("keywords"), 1);
    $search->add($GLOBALS['plugin']->getValue("alt"), 2);
    $search->build($GLOBALS['plugin']->getValue("title"), $GLOBALS['plugin']->getValue("description"));
}

$GLOBALS['plugin']->setAdminModule('e');

?>
