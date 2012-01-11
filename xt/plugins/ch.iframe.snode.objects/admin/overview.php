<?php
function_exists("zend_loader_file_licensed") ? XT::checkDomain(zend_loader_file_licensed()) : null;

XT::enableAdminNavigator('content_types', 'id');
XT::enableAdminCharFilter('title');

$result = XT::query("
    SELECT
        id,
        title,
        content_table,
		icon
    FROM 
        " . $GLOBALS['plugin']->getTable('content_types') .
        " " . $GLOBALS['plugin']->getCharFilter()  . "
    ORDER BY
        title ASC
    LIMIT " . $GLOBALS['plugin']->getLimiter()
, __FILE__, __LINE__);

$data = XT::getQueryData($result);

XT::assign('DATA', $data);

$content = XT::build('overview.tpl');
?>