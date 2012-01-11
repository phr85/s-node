<?php

if($GLOBALS['plugin']->getSessionValue('node_id') != ''){
    // Get some relevant entries for the corresponding node_id and order it by creation_date to get the first entry for this node_id
    $sql = "SELECT
            lang,(creation_date + 1) as creation_date
            ,node_id,
            title,
            tpl_file,
            public,
            visible,
            show_in_overview,
            header,
            footer,
            css
        FROM
            " . $GLOBALS['plugin']->getTable("navigation_details") . "
        WHERE
            node_id = " . $GLOBALS['plugin']->getSessionValue('node_id') . "
        ORDER BY
        	creation_date ASC
    ";
     // Execute the query
	 $result = XT::query($sql,__FILE__,__LINE__);
	 //store JUST THE FIRST ROW into a value, to use it later in editPage.php
	 $row = $result->FetchRow();
	 XT::setValue("originalRow",$row);
}
?>