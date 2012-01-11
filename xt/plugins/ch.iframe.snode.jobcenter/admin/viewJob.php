<?php

$data['data']['id'] = XT::getValue("id");
XT::assign("EDIT", $data['data']);

// Build plugin
$content = XT::build('viewJob.tpl');

?>