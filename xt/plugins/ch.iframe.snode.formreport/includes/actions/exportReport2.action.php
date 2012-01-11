<?php
include CLASS_DIR . "writeexcel/class.writeexcel_workbook.inc.php";
include CLASS_DIR . "writeexcel/class.writeexcel_worksheet.inc.php";

$fname = tempnam("ROOT_DIR", "output.xls");
$workbook = &new writeexcel_workbook($fname);
$heading =& $workbook->addformat(array('bold' => 1));
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
 	$elements[$element['element_id']]['pos'] = $element['pos'];
 	
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
ORDER BY session_id, id ASC;
",__FILE__,__LINE__);
$i = 0;
$i++;
while($rowfillouts = $rsfillouts->FetchRow()){
	$worksheet[$rowfillouts["id"]] = &$workbook->addworksheet($rowfillouts["id"]);
	
	$worksheet[$rowfillouts["id"]]->write(0, 0,  "Session",$heading);
	$worksheet[$rowfillouts["id"]]->write(0, 1,  $rowfillouts["session_id"],$heading);
	
	$worksheet[$rowfillouts["id"]]->write(1, 0,  "Datum der Uebermittlung",$heading);
	$worksheet[$rowfillouts["id"]]->write(1, 1,  date('d.m.Y H:i:s',$rowfillouts["submission_date"]),$heading);
	
	$worksheet[$rowfillouts["id"]]->write(3, 0,  "Position",$heading);
	$worksheet[$rowfillouts["id"]]->write(3, 1,  "Frage",$heading);
	$worksheet[$rowfillouts["id"]]->write(3, 2,  "Antwort",$heading);
	$startrow = 4;
	
	$results = XT::query("
	SELECT
		*
	FROM
		" . XT::getTable('forms_data') . "
	WHERE
		fillout_id = " . $rowfillouts['id'] . "
	",__FILE__,__LINE__);
	while($result = $results->FetchRow()){
		$key = md5($result['element_id'] . $rowfillouts['id']);
		if ($data[$key] != "") {
			$data[$key] = $data[$key]  . ";" . $result['element_value'];
		} else {
			$data[$key] = $result['element_value'];
		}
		
		$worksheet[$rowfillouts["id"]]->write(($elements[$result['element_id']]['pos'] + $startrow), 0, $elements[$result['element_id']]['pos']);
		$worksheet[$rowfillouts["id"]]->write(($elements[$result['element_id']]['pos'] + $startrow), 1, $elements[$result['element_id']]['label']);
		$worksheet[$rowfillouts["id"]]->write(($elements[$result['element_id']]['pos'] + $startrow), 2, $data[$key]);

	}
	
}

$workbook->close();

header("Content-Type: application/octet-stream");
header("Content-Disposition: inline; filename=\"download.xls\"");
$fh=fopen($fname, "rb");
fpassthru($fh);
unlink($fname);
?>