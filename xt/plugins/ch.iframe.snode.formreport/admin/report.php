<?php
// Get the details for the report
$reportdata = XT::query("
SELECT
	*
FROM
	" . XT::getTable('formreport') . "
WHERE
	id = " . XT::getValue("id") . "
",__FILE__,__LINE__);
$reportdatas = XT::getQueryData($reportdata);

// Assign the start and end time of the report
$end = $reportdatas[0]['time_end'];
$start = $reportdatas[0]['time_start'];

// Asign the related form
$form_id = $reportdatas[0]['form_id'];

// get all elements of the form
$rsform_elements = XT::query("
SELECT
	*
FROM
	" . XT::getTable('forms_elements') . "
WHERE
	form_id = " . $form_id . "  AND (element_type = 2 OR element_type = 3 OR element_type = 4 OR element_type = 5 OR element_type = 1 OR element_type = 11) ORDER BY pos ASC 
",__FILE__,__LINE__);
 while($element = $rsform_elements->FetchRow()){
 	// assign the label and type to the elements array
 	$elements[$element['element_id']]['label'] = $element['label'];
 	$elements[$element['element_id']]['element_type'] = $element['element_type'];
 	
 	// get the labels for the fix answers
 	if ($element['element_type'] != 1 AND $element['element_type'] != 11) {
	 	$results = XT::query("
		SELECT
			*
		FROM
			" . XT::getTable('forms_elements_values') . "
		WHERE
			element_id = " . $element['element_id'] . "
		",__FILE__,__LINE__);
		while($result = $results->FetchRow()){
			$elements[$element['element_id']]['values'][$result['label']] = $result['value'];
		}
 	} else {
 		$elements[$element['element_id']]['values']['xx'] = $result['value'];
 	}
 }

$rsfillouts = XT::query("
		SELECT
			id
		FROM
			" . XT::getTable('forms_fillouts') . "
		WHERE
			submission_date > " . $start . " AND submission_date < " . $end . " AND form_id = " . $form_id . "  
		",__FILE__,__LINE__);
$maxfillouts = 0;
while($rowfillouts = $rsfillouts->FetchRow()){
	$results = XT::query("
	SELECT
		*
	FROM
		" . XT::getTable('forms_data') . "
	WHERE
		fillout_id = " . $rowfillouts['id'] . "
	",__FILE__,__LINE__);
	$emptyTest = 0;
	while($result = $results->FetchRow()){
		$data[$result['element_id']][$result['element_value']]++;
		$maindata[$result['element_id']]++;
			$emptyTest++;
		}
	if ($emptyTest > 0){
 		$maxfillouts++;
	}
 }

// fill empty
foreach ($elements as $element_id=>$element) {
	if ($element['element_type'] != 1 AND $element['element_type'] != 11) {
		foreach ($element['values'] as $lavel=>$value) {
			if($data[$element_id][$value] > 0){
				
			} else {
				$data[$element_id][$value] = 0;
			}
		}
	}
}


//******************************************************************************************************
//assignen der daten welche im template verf�gbar sein sollen f�r die grafische auswertung
//******************************************************************************************************
XT::assign("ANSWERS", $data);
XT::assign("ANSWER_MAIN", $maindata);
XT::assign("ANZAHL", $maxfillouts);
XT::assign("POLLDATA", $reportdatas);
XT::assign("QUESTIONS", $elements);

//******************************************************************************************************
//dem contentbereich wird ein template zugewiesen
//******************************************************************************************************

$content = XT::build('report.tpl');


?>