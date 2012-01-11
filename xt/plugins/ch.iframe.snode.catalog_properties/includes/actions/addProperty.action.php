<?php
XT::setSessionValue('previousAdminModule', XT::getSessionValue('adminModule'));
// Add Property field in all languages
// get max value
$max = XT::getQueryData(
                       XT::query("
                                SELECT
                                    max(id) as max 
                                FROM 
                                    " . XT::getTable('fields')
                       ,__FILE__,__LINE__,0)
                       );

// insert empty field in all languages with id max+1
foreach ($GLOBALS['cfg']->getLangs() as $key => $lang){
    XT::query("INSERT INTO
                  " . XT::getTable('fields') . "
                  (id, lang, title, description)
              VALUES
                  (" . ($max[0]['max']+1) . ", '" . $key . "', '', '')",__FILE__,__LINE__,0);

}
// set Property ID to session
XT::setSessionValue('property_id',($max[0]['max']+1));
XT::setValue('property_id',($max[0]['max']+1));
// switch to edit properties
XT::setAdminModule('pe');
?>
