<?php

// Handle order requests
if(XT::getValue("order_by") != ''){
    XT::setSessionValue("order_by", XT::getValue("order_by"));
}
if(XT::getValue("order_by_dir") != ''){
    XT::setSessionValue("order_by_dir", XT::getValue("order_by_dir"));
}
if(XT::getSessionValue('order_by') != '' && XT::getSessionValue('order_by_dir') != ''){
    $order_by = XT::getSessionValue('order_by') . ' ' . XT::getSessionValue('order_by_dir');
} else {
    $order_by = 'pd.title ASC';
    XT::setSessionValue('order_by','pd.title');
    XT::setSessionValue('order_by_dir','asc');
}

// Get installed packages
$result = XT::query("
    SELECT
        p.id, 
        p.package, 
        (p.version/1000) as version, 
        p.provider, 
        pd.title, 
        pd.description
    FROM 
        " . XT::getTable('plugins_packages') . " AS p LEFT JOIN
        " . XT::getTable('plugins_packages_details') . " AS pd ON (pd.id = p.id AND pd.lang = '" . $GLOBALS['plugin']->getActiveLang() . "')
    WHERE
        pd.title != ''
    ORDER BY 
        " . $order_by . "
", __FILE__, __LINE__);

$data = array();
while($row = $result->FetchRow()){
    if(XT::getSessionValue("open") == $row['id']){
        $open_package = $row['package'];
    }
    $data[] = $row;
}
XT::assign("LANGS",$GLOBALS['cfg']->getLangs());
XT::assign("PACKAGES", $data);
XT::assign("ORDER_BY_DIR", XT::getSessionValue('order_by_dir'));
XT::assign("ORDER_BY", XT::getSessionValue('order_by'));

$content = XT::build('overview.tpl');

?>