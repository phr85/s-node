<?PHP
XT::query("DELETE 
   FROM 
       " . XT::getTable('pools_rel') . " 
   WHERE 
       node_id= " . $GLOBALS['plugin']->getSessionValue('open') . " 
   AND 
       principal_id= " . $GLOBALS['plugin']->getValue('user_id') . "
   AND 
       principal_type=1",__FILE__,__LINE__);
?>
