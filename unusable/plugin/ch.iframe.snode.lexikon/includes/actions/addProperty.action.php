<?php
$GLOBALS['plugin']->setSessionValue('previousAdminModule', $GLOBALS['plugin']->getSessionValue('adminModule'));
// Add Property field in all languages
// get max value
$max = XT::getQueryData(XT::query("SELECT max(id) as max FROM " . $GLOBALS['plugin']->getTable('fieldnames'),__FILE__,__LINE__,0));

// insert empty field in all languages with id max+1
foreach ($GLOBALS['cfg']->getLangs() as $key => $lang){
    XT::query("INSERT INTO
                  " . $GLOBALS['plugin']->getTable('fieldnames') . "
                  (id, lang, fieldname, description)
              VALUES
                  (" . ($max[0]['max']+1) . ", '" . $key . "', '', '')",__FILE__,__LINE__,0);

}
// set Property ID to session
$GLOBALS['plugin']->setSessionValue('property_id',($max[0]['max']+1));
// switch to edit properties
$GLOBALS['plugin']->setAdminModule('pe');
?>
