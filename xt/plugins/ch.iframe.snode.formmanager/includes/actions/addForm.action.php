<?php

$limit_exceeded = false;

// Limitation check
if(function_exists("zend_loader_file_licensed")){
    $lic_info = @zend_loader_file_licensed();
    if($lic_info['Limit'] > 0){
    	$result = XT::query("
            SELECT count(id) as count_id FROM " . $GLOBALS['plugin']->getTable("forms")
        ,__FILE__,__LINE__);

        while($row = $result->FetchRow()){
            if($row['count_id']+1 > $lic_info['Limit']){
                XT::log("Ihre Lizenz des Formularmanagers erlaubt nur " . $lic_info['Limit'] . " Formulare. Upgrade auf S-Node.com",__FILE__,__LINE__,XT_ERROR);
                $limit_exceeded = true;
            }
        }
    }
}

if(!$limit_exceeded){
    XT::query("
        INSERT INTO " . $GLOBALS['plugin']->getTable("forms") . "
        (
            title,
            lang
        ) VALUES (
            'Form',
            'de'
        )", __FILE__,__LINE__);

    $result = XT::query("SELECT id FROM " . $GLOBALS['plugin']->getTable("forms") . " ORDER BY id DESC LIMIT 1");
    $data = XT::getQueryData($result);

    $GLOBALS['plugin']->setValue("form_id", $data[0]['id']);
    $GLOBALS['plugin']->setAdminModule("ef");
}

?>
