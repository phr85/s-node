<?php

$query = XT::Query("
    INSERT INTO " . XT::getTable('faq') . " (
        questioner,
        questioner_mail,
        title,
        description,
        date,
        lang,
        customer_type,
        customer_country
    )
    VALUES(
        '" . XT::getValue('name') . "',
        '" . XT::getValue('email') . "',
        '" . XT::getValue('title') . "',
        '" . XT::getValue('message') . "',
        '". TIME ."',
        '" . XT::getLang() . "',
        '" . XT::getValue('customer_type') . "',
        '" . XT::getValue('customer_country') . "'
    )
",__FILE__,__LINE__);

$result = XT::query("
    SELECT
        id
    FROM
        " . XT::getTable('faq'). "
    WHERE
        questioner = '" . XT::getValue('name') . "' AND
        questioner_mail = '" . XT::getValue('email') . "' AND
        title = '" . XT::getValue('title') . "' AND
        description = '" . XT::getValue('message') . "'AND
        date = '". TIME ."' AND
        lang = '" . XT::getLang() . "' AND
        customer_type = '" . XT::getValue('customer_type') . "' AND
        customer_country = '" . XT::getValue('customer_country') . "'
",__FILE__,__LINE__);
$row = $result->FetchRow();
    
XT::query("
    INSERT INTO " . XT::getTable('faq2cat') . "(
        faq_id,
        node_id
    ) VALUES (
        " . $row['id'] . ",
        2
    )
",__FILE__,__LINE__);

// Set Values for Notify Action

XT::setValue('name',XT::getValue('name'));
XT::setValue('email',XT::getValue('email'));
XT::setValue('title',XT::getValue('title'));
XT::setValue('message',XT::getValue('message'));
XT::setValue('customer_type',XT::getValue('customer_type'));
XT::setValue('customer_country',XT::getValue('customer_country'));
    
// Notify Admins that a new Question was entered
XT::call('notify');
    
?>