<?php 

// Parameter :: Style
$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';

$result = XT::query("
        SELECT
            *
        FROM
            " . XT::getTable('poll') . "
        WHERE
        	active = 1 AND date < " . time() . "
        ORDER BY
        	date desc        	
        "
, __FILE__, __LINE__);

$data['viewertpl'] = XT::getParam('viewertpl');
$data['polls'] = XT::getQueryData($result);

XT::assign("xt" . XT::getBaseID() . "_list", $data);

$content = XT::build($style);

?>