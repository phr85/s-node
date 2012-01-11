<?php
if (XT::getValue("id") != "") {
    /**
     * Copy article
     */
    $result = XT::query("
        SELECT
            unit,
            quantity,
            art_nr,
            active,
            edate,
            cdate,
            pkg_unit,
            stock,
            min_stock
        FROM
            " . XT::getTable("articles") . "
        WHERE
            id=" . XT::getValue("id")
    ,__FILE__,__LINE__);

    $row = $result->fetchRow();

    $result = XT::query("
	   INSERT INTO
	       " . XT::getTable("articles") . "
            (
                unit,
                quantity,
                art_nr,
                active,
                edate,
                cdate,
                pkg_unit,
                stock,
                min_stock
            ) VALUES
            (
                '" . $row['unit'] . "',
                '" . $row['quantity'] . "',
                '" . $row['art_nr'] . "',
                0,
                0,
                " . time() . ",
                '" . $row['pkg_unit'] . "',
                '" . $row['stock'] . "',
                '" . $row['min_stock'] . "'
            );
        ",__FILE__,__LINE__);

    $result = XT::query("SELECT MAX(id) as id FROM " . XT::getTable("articles"),__FILE__,__LINE__);

    $row = $result->fetchRow();
    $new_id = $row['id'];

    /**
	 * Get all details
	 */
    $result = XT::query("
        SELECT
            lang,
            title,
            subtitle,
            lead,
            description,
            active
        FROM
            " . XT::getTable("articles_details") . "
        WHERE
            id=" . XT::getValue("id") 
    ,__FILE__,__LINE__);

    while ($row = $result->fetchRow()) {
        $cResult = XT::query("
            INSERT INTO
               " . XT::getTable("articles_details") . "
                (
                    id,
                    lang,
                    title,
                    subtitle,
                    lead,
                    description,
                    active,
                    product_of_month
                ) VALUES (
                    " . $new_id . ",
                    '" . $row['lang'] . "',
                    '*** " . addslashes($row['title']) . "',
                    '" . addslashes($row['subtitle']) . "',
                    '" . addslashes($row['lead']) . "',
                    '" . addslashes($row['description']) . "',
                    0,
                    0
                )
    	",__FILE__,__LINE__);

        /**
         * Copy field rels
         */
        $cResult = XT::query("
            SELECT
                field_id,
                display
            FROM
                " . XT::getTable("fields_rel") . "
            WHERE
                article_id = " . XT::getValue("id") . " AND
                lang='" . $row['lang'] . "'
		",__FILE__,__LINE__);
        
        
        while ($cRow = $cResult->fetchRow()) {
        	XT::query("
                INSERT INTO
                    " . XT::getTable("fields_rel") . "
                    (
                        article_id,
                        lang,
                        field_id,
                        display
                    ) VALUES (
                        " . $new_id . ",
                        '" . $row['lang'] . "',
                        " . $cRow['field_id'] . ",
                        '" . addslashes($cRow['display']) . "'
                    )
        	",__FILE__,__LINE__);
        }
        
        /**
         * Copy fields values
         */
        $cResult = XT::query("
            SELECT
                field_id,
                position,
                value,
                label
            FROM
                " . XT::getTable("fields_values") ."
            WHERE
                article_id=" . XT::getValue("id") . " AND
                lang='" . $row['lang'] . "' 
        ",__FILE__,__LINE__);
        
        while ($cRow = $cResult->fetchRow()) {
        	XT::query("
        	   INSERT INTO
        	       " . XT::getTable("fields_values") . "
	               (
	                   article_id,
	                   lang,
	                   field_id,
	                   position,
	                   value,
	                   label
	               ) VALUES (
	                   " . $new_id . ",
	                   '" . $row['lang'] . "',
	                   '" . $cRow['field_id'] . "',
	                   '" . $cRow['position'] . "',
	                   '" . addslashes($cRow['value']) . "',
	                   '" . addslashes($cRow['label']) . "'
	               )
        	",__FILE__,__LINE__);
        }
    }
    
        /**
         * Copy images
         */
        $cResult = XT::query("
            SELECT
                image_id,
                image_version,
                is_main_image,
                position
            FROM
                " . XT::getTable("images") . "
            WHERE
                article_id=" . XT::getValue("id") 
        ,__FILE__,__LINE__);
        
        
        while ($cRow = $cResult->fetchRow()) {
        	XT::query("
        	   INSERT INTO
        	       " . XT::getTable("images") . "
    	           (
    	               article_id,
    	               image_id,
                       image_version,
                       is_main_image,
                       position
    	           ) VALUES (
    	               "  . $new_id . ",
    	               "  . $cRow['image_id'] . ",
    	               "  . $cRow['image_version'] . ",
    	               "  . $cRow['is_main_image'] . ",
    	               "  . $cRow['position'] . "
    	           )
        	", __FILE__,__LINE__);
        }


}
else {
    XT::log("Could not copy article", __FILE__,__LINE__, XT_WARNING);
}
?>