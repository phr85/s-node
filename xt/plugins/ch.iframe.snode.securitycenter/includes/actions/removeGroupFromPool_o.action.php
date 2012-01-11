<?PHP
XT::query("DELETE 
   FROM 
       " . XT::getTable('pools_rel') . " 
   WHERE 
       node_id= " . $GLOBALS['plugin']->getValue('node_id') . " 
   AND 
       principal_id= " . $GLOBALS['plugin']->getValue('principal_id') . "
   AND 
       principal_type=2",__FILE__,__LINE__);

$GLOBALS['plugin']->setAdminModule('o');

?>