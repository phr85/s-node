<?php

function_exists("zend_loader_file_licensed") ? XT::checkDomain(zend_loader_file_licensed()) : null;

$result = XT::query("
    SELECT
        p.id, 
        p.package, 
        (p.version/1000 ) as version, 
        p.provider, 
        pd.title, 
        pd.description
    FROM 
        " . $GLOBALS['plugin']->getTable('plugins_packages') . " AS p LEFT JOIN
        " . $GLOBALS['plugin']->getTable('plugins_packages_details') . " AS pd ON (pd.id = p.id AND pd.lang = '" . $GLOBALS['plugin']->getActiveLang() . "')
    WHERE
        pd.title != ''
    ORDER BY 
        pd.title,
        pd.id ASC
", __FILE__, __LINE__);

XT::assign("INSTALLED", XT::getQueryData($result));

$content = XT::build('overview.tpl');
?>
