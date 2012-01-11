<?php
// Enable Char filter and navigator
XT::enableAdminCharFilter('title');
XT::enableAdminNavigator('forms');

$result = XT::query("
    SELECT
        id,
        title,
        active
    FROM
        " . $GLOBALS['plugin']->getTable("forms") .  "
    WHERE
        lang = 'de'
        " . XT::getAdminCharFilter('AND') . "
    ORDER BY
        title ASC
    LIMIT
            " . XT::getAdminNavigatorLimit() . "
    ",__FILE__,__LINE__);

XT::assign("field", XT::getValue("field"));
if(XT::getValue("form")!= ""){
	XT::assign("form", XT::getValue("form"));
} else {
	XT::assign("form", 0);
}
XT::assign("titlefield", XT::getValue("titlefield"));
XT::assign("DATA", XT::getQueryData($result));
$content = XT::build("forms_selector.tpl");
?>
