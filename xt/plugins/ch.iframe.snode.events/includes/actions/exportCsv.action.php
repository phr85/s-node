<?php
$result = XT::query("
    SELECT
        event_id,
        address_id,
        person_nr,
        fieldname as name,
        fieldvalue as value
    FROM
        " . XT::getTable("events_registrations_details") . "
    WHERE
        event_id = " . XT::getSessionValue("event_id")  . "
", __FILE__,__LINE__);

while($row = $result->fetchRow()){
	$eventdata[$row['address_id']][$row['person_nr']][$row['name']] = $row['value'];
    $fieldnames[$row['name']]=$row['name'];
}
// feldtitel in erste Zeile Schreiben
$csv_output = "id," . implode(",",$fieldnames);
$csv_output .= "\n";
 
foreach ($eventdata as $addr_id => $address) {
	foreach ($address as $person_nr => $registred_person) {
			// Personen in eine Zeile eintragen mit " als delimeter
			$csv_output .= $addr_id;
			foreach ($fieldnames as $value) {
				$csv_output .= ",\"" . str_replace(array("\l","\n","\t","\r","\x0B")," ",$registred_person[$value]) . "\"";
		}
		$csv_output .= "\n";
	}
}
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".xls");
header('Content-Disposition: attachment; filename="regs.csv"');
print $csv_output;
exit;
?>