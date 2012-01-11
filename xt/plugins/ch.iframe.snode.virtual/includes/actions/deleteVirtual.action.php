<?php
XT::query("DELETE FROM 
                " . $GLOBALS['plugin']->getTable('virtual_url') . " 
           WHERE    
                id= ". $GLOBALS['plugin']->getValue('virtual_id'), __FILE__, __LINE__);
?>