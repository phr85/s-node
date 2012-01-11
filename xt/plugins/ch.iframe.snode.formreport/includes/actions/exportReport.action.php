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
	form_id = " . $form_id . "  AND (element_type = 2 OR element_type = 3 OR element_type = 4 OR element_type = 5 OR element_type = 1 OR element_type = 11) 
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
			$elements[$element['element_id']]['key'][$result['value']] = $result['label'];
		}
 	} else {
 		$elements[$element['element_id']]['values']['xx'] = $result['value'];
 	}
 }

$rsfillouts = XT::query("
		SELECT
			*
		FROM
			" . XT::getTable('forms_fillouts') . "
		WHERE
			submission_date > " . $start . " AND submission_date < " . $end . " AND form_id = " . $form_id . "  
		",__FILE__,__LINE__);
$i = 0;
$i++;
while($rowfillouts = $rsfillouts->FetchRow()){
	$results = XT::query("
	SELECT
		*
	FROM
		" . XT::getTable('forms_data') . "
	WHERE
		fillout_id = " . $rowfillouts['id'] . "
	",__FILE__,__LINE__);
	while($result = $results->FetchRow()){
		$csv[$i][0] = $i; 
		$csv[$i][1] = $rowfillouts['id'];
		$csv[$i][2] = $result['element_id'];
		$csv[$i][3] = $elements[$result['element_id']]['label'] ;
		$csv[$i][4] = $elements[$result['element_id']]['key'][$result['element_value']];
		$csv[$i][5] = $result['element_value'];
		$csv[$i][6] = date("d.m.Y H:i:s",$rowfillouts['submission_date']);
		$csv[$i][7] = $rowfillouts['session_id'];
		$i++;
		}
 }

$output = "<table><tr><td>id</td><td>fillout_id</td><td>element_id</td><td>element_label</td><td>element_key</td><td>element_value</td><td>date</td><td>session_id</td></tr>\r\n";
foreach($csv as $data) {
	$output .= "<tr><td>" . $data[0] . "</td><td>" . $data[1] . "</td><td>" . $data[2] . "</td><td>" . $data[3] . "</td><td>" . $data[4] . "</td><td>" . $data[5] . "</td><td>" . $data[6] . "</td><td>" . $data[7] . "</td></tr>>" . "\r\n"; 
}
$output .= "</table>";
header('Content-Type: application/octet-stream');
header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Content-Disposition: attachment; filename=download.xls');
header('Pragma: no-cache');
echo $output;
exit;
// fill empty
/*foreach ($elements as $element_id=>$element) {
	if ($element['element_type'] != 1 AND $element['element_type'] != 11) {
		foreach ($element['values'] as $lavel=>$value) {
			if($data[$element_id][$value] > 0){
				
			} else {
				$data[$element_id][$value] = 0;
			}
		}
	}
}*/
?>