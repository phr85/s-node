<?php

XT::query("
    INSERT INTO
        " . XT::getDatabasePrefix() . "newsletter_categories
    (
        creation_date,
        creation_user
    ) VALUES (
        " . time() . ",
        " . XT::getUserID() . "
    )
",__FILE__,__LINE__);

$result = XT::query("
    SELECT
        id
    FROM
        " . XT::getDatabasePrefix() . "newsletter_categories
    ORDER BY
        id DESC LIMIT 1
",__FILE__,__LINE__);

while($row = $result->FetchRow()){
    XT::setValue('category_id',$row['id']);
}

XT::setAdminModule('ec');

?>
