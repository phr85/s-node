<?php

function_exists("zend_loader_file_licensed") ? XT::checkDomain(zend_loader_file_licensed()) : null;

// Ordering
XT::loadClass("ordering.class.php","ch.iframe.snode.core");
$order = new XT_Order("jd.title,a.city,j.id,j.job_id","jd.title",1,"overview");
$order->setListener("sort","sortby");

// Charfilter
XT::enableAdminCharFilter('jd.title');

// Navigator
XT::enableAdminNavigator('','',"
    SELECT
        count(j.id)  as count_id
    FROM
        " . XT::getTable('jobs') . " as j
    LEFT JOIN
        " . XT::getTable('jobs_detail') . " as jd ON (j.id = jd.id and jd.lang = '" . XT::getActiveLang() . "')
        " . XT::getAdminCharFilter() . "
",__FILE__,__LINE__);

// Get Jobs list
$result = XT::query("
    SELECT
        j.id,
        j.job_id,
        jd.title,
        jd.active,
        a.city as location_city,
        count(application.id) as application_count
    FROM
        " . XT::getTable('jobs') . " as j
    LEFT JOIN
        " . XT::getTable('jobs_detail') . " as jd ON (j.id = jd.id and jd.lang = '" . XT::getActiveLang() . "')
    LEFT JOIN
        " . XT::getTable('addresses') . " as a ON (j.location_id = a.id)
    LEFT JOIN
        " . XT::getTable('jobs_applications') . " as application on (j.id = application.job_id)
        " . XT::getAdminCharFilter() . "
    GROUP BY
        j.id
        " . $order->get() . "
    LIMIT
        " . XT::getAdminNavigatorLimit() . "
",__FILE__,__LINE__);

// Button
XT::addImageButton("Add a new job offer", "addJob" , "default", "add.png", "0","slave1","addjob");

XT::assign("DATA", XT::getQueryData($result));
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

// Build plugin
$content = XT::build('overview.tpl');

?>