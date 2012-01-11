<?php
XT::setValue("category_id", (XT::getValue("category_id") == "" ? 0 : XT::getValue("category_id")));

$result = XT::query("
    DELETE FROM
        " . XT::getDatabasePrefix() . "newsletter_categories
    WHERE
        id=" . XT::getValue("category_id") 
,__FILE__,__LINE__);

XT::query("
    DELETE FROM
        " . XT::getDatabasePrefix() . "newsletter_newsl2cat 
    WHERE
        category_id=" . XT::getValue("category_id")
,__FILE__,__LINE__);

XT::query("
    DELETE FROM
        " . XT::getDatabasePrefix() . "newsletter_subscr2cat
    WHERE
        category_id = " . XT::getValue("category_id")
,__FILE__,__LINE__);

?>