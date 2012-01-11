<?php

	// Update Category of this item
	
	XT::query("
    UPDATE 
        " . XT::getTable("faq2cat") . " 
    SET
        node_id = 2
    WHERE
        faq_id = " . XT::getValue('cid') . "",__FILE__,__LINE__);
        
?>