<?php

function_exists("zend_loader_file_licensed") ? XT::checkDomain(zend_loader_file_licensed()) : null;

// Ordering
XT::loadClass("ordering.class.php","ch.iframe.snode.core");
$order = new XT_Order("last_name.value,job_detail.title,job_detail.id,application.creation_date","last_name.value",1,"list");
$order->setListener("sort","sortby");

// Charfilter
XT::enableAdminCharFilter('last_name.value');

// Navigator
XT::enableAdminNavigator('','',"
    SELECT
        count(application.id) as count_id
    FROM
        " . XT::getTable('jobs_applications') . " as application
    INNER JOIN
        " . XT::getTable('jobs_applications_values') . " as last_name on (last_name.application_id = application.id AND last_name.key = 'last_name')
    " . XT::getAdminCharFilter() . "
",__FILE__,__LINE__);

// Get Jobs list
$result = XT::query("
    SELECT
        application.*,
        last_name.value as last_name,
        first_name.value as first_name,
        job_detail.id as job_id,
        job_detail.title as job_title
    FROM
        " . XT::getTable('jobs_applications') . " as application
    INNER JOIN
        " . XT::getTable('jobs_applications_values') . " as last_name on (last_name.application_id = application.id AND last_name.key = 'last_name')
    INNER JOIN
        " . XT::getTable('jobs_applications_values') . " as first_name on (first_name.application_id = application.id AND first_name.key = 'first_name')
    LEFT JOIN
        " . XT::getTable('jobs_detail') . " as job_detail on (job_detail.id = application.job_id AND job_detail.lang = '" . XT::getActiveLang() . "')
        " . XT::getAdminCharFilter() . "
        " . $order->get() . "
    LIMIT
        " . XT::getAdminNavigatorLimit() . "
",__FILE__,__LINE__);

XT::assign("DATA", XT::getQueryData($result));
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

// Build plugin
$content = XT::build('applications.tpl');

?>