<?php

// Add buttons
XT::addImageButton('Add category','addCategory','default','add.png','0','slave1','a');

// Get newsletters
$result = XT::query("
    SELECT
        id,
        title
    FROM
        " . XT::getDatabasePrefix() . "newsletter_categories
    ORDER BY title ASC
",__FILE__,__LINE__);

$categories = array();
while($row = $result->FetchRow()){
    $categories[] = $row;
}

XT::assign("CATEGORIES", $categories);

$content = XT::build('categories.tpl');

?>
