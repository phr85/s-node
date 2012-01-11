<?php

XT::query("
DELETE
FROM
    " . XT::getTable('tickets') . "
WHERE
	id=" . XT::getValue('id') . "
",__FILE__,__LINE__);

XT::query("
DELETE
FROM
    " . XT::getTable('tickets_history') . "
WHERE
	ticket_id=" . XT::getValue('id') . "
",__FILE__,__LINE__);

?>