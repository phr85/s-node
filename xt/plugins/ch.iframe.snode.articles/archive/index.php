<?php

// Parameter :: Style
$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';

// Parameter :: Months
$monate_zurueck = XT::autoval("months_back","R");

$result = XT::query("SELECT
						date,node_id,creation_date
					FROM
						" . XT::getTable("articles") . "
					LEFT JOIN
						xt_articles_tree_rel ON xt_articles.id = xt_articles_tree_rel.article_id
					WHERE
						active = 1
					AND
						node_id IS NOT NULL
					AND
						date IS NOT NULL	
					ORDER BY 
						date ASC
					LIMIT 1
					");

$firstEntry = XT::getQueryData($result);
$firstEntryDate = $firstEntry[0]['creation_date'];

$firstMonth = time() - $firstEntryDate;

$monthsBetween = $firstMonth / 2592000;

if (!$monate_zurueck){
	$monate_zurueck = ceil($monthsBetween);	
}

date(mktime(0,0,$firstMonth,0,0,0));

$data = array();
$monat =  date("n",TIME);
$jahr = date("Y",TIME);

for ($i = $monate_zurueck; $i >= 1; $i--){
	$tmp = array();
	$tmp['monat']= date("M",mktime(0,0,0,$monat,1,$jahr));
	$tmp['intmonat']= date("n",mktime(0,0,0,$monat,1,$jahr));
	$tmp['value']= $tmp['intmonat'] . "," . $jahr;
	$tmp['jahr'] = $jahr;
	// wenn selected selected flag setzen und range für article_list setzen
	if(XT::autoval("month","R",false) == $tmp['value']){
		$tmp['selected'] = true;
		XT::setSessionValue("visibleRangeFrom",mktime(0,0,0,$tmp['intmonat'],1,$jahr));
		XT::setSessionValue("visibleRangeTo",(mktime(0,0,0,($tmp['intmonat'] +1),1,$jahr)-86400));
	}
	$data[]= $tmp;
	--$monat;
	if ($monat == 0){
		--$jahr;
		$monat = 12;
	}
}

XT::assign("xt" . XT::getBaseID() . "_archive", $data);

$content = XT::build($style);

?>