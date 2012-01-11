<?php
XT::call("saveElement");
$result = XT::query("
    SELECT
        COUNT(*) AS existing
    FROM
        " . XT::getTable("forms_elements_rules") . "
    WHERE
        form_id=" . XT::getSessionValue("form_id") . " AND
        element_id=" . XT::getValue("element_id") . " AND
        compare_query='!=' AND
        compare_type=1 AND
        value='' AND
        lang='" . XT::getLang() . "'
",__FILE__,__LINE__);

$row = $result->fetchRow();

if($row['existing'] > 0 && XT::getValue("required") != "1") {
    $result = XT::query("
        DELETE FROM 
            " . XT::getTable("forms_elements_rules") . "
        WHERE
            form_id=" . XT::getSessionValue("form_id") . " AND
            element_id=" . XT::getValue("element_id") . " AND
            compare_query='!=' AND
            compare_type=1 AND
            value='' AND
            lang='" . XT::getLang() . "'
        ",__FILE__,__LINE__);
}
elseif(XT::getValue("required") == "1") {
	$result = XT::query("
	   INSERT INTO
	       " . XT::getTable("forms_elements_rules") . "
           (form_id,element_id,compare_query, compare_type, value_field, value_query, value_type, value,title,lang, error_msg)
       VALUES
            (" . XT::getSessionValue("form_id") . ", " . XT::getValue("element_id") . ", '!=', 1, '','',1,'','Rule','" . XT::getLang() . "','!')
	",__FILE__,__LINE__);
}
?>