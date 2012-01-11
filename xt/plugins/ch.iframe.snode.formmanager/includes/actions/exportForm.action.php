<?php

$formid = XT::getValue('form_id');

$xmlcontent = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
$xmlcontent .= '<form>' . "\n";

/*
 * Forms
 */
$xmlcontent .= '    <mysql>' . "\n";
$xmlcontent .= '        <![CDATA[' . "\n";
// Get all form data except of the id, that is to generate later with the import 
$result = XT::query("
    SELECT
        *
    FROM 
        " . XT::getTable("forms") . "
    WHERE
        id=" . $formid
,__FILE__,__LINE__);

$row = $result->fetchRow();
$form_name = $row['title'];
$i = 0;
// Adjust the title to detect the data later
$row["title"] = $row["title"] . " (IMPORTED " . date("d.m.Y") . " )";

foreach($row as $key=>$value) {
	if ($key != "id"){
		$r[$i]['key'] = $key;
		$r[$i]['value'] = $value;
		$i++;
	}
}
$xmlcontent .= '        INSERT INTO {PREFIX}forms (';
foreach ($r as $sqldata) {
	$xmlcontent .= '`' . $sqldata['key'] . '`,';
}
$xmlcontent = substr($xmlcontent,0,strlen($xmlcontent) -1);
$xmlcontent .= ')VALUES(';

foreach ($r as $sqldata) {
	$xmlcontent .= '\'' . $sqldata['value'] . '\',';
}
$xmlcontent = substr($xmlcontent,0,strlen($xmlcontent) -1);
$xmlcontent .= ');' . "\n";

$xmlcontent .= '        ]]>' . "\n";
$xmlcontent .= '    </mysql>' . "\n";

/*
 * form elements
 */
 
// Get all forms_elements data except of the element_id, that is to generate later with the import 
$result = XT::query("
    SELECT
        *
    FROM 
        " . XT::getTable("forms_elements") . "
    WHERE
        form_id=" . $formid
,__FILE__,__LINE__);

while($row = $result->fetchRow()){
	$r = array();
	$sqldata = array();
	$xmlcontent .= '    <element>' . "\n";
	$xmlcontent .= '        <mysql>' . "\n";
	$xmlcontent .= '            <![CDATA[' . "\n";
	$i = 0;
	foreach($row as $key=>$value) {
		if ($key != "element_id"){
			$r[$i]['key'] = $key;
			if ($key == "form_id"){
				$r[$i]['value'] = "xx";
			} else {
				$r[$i]['value'] = $value;
			}
		}
		$i++;
	}
	$xmlcontent .= '            INSERT INTO {PREFIX}forms_elements (';
	foreach ($r as $sqldata) {
		$xmlcontent .= '`' . $sqldata['key'] . '`,';
	}
	$xmlcontent = substr($xmlcontent,0,strlen($xmlcontent) -1);
	$xmlcontent .= ')VALUES(';
	
	foreach ($r as $sqldata) {
		$xmlcontent .= '\'' . $sqldata['value'] . '\',';
	}
	$xmlcontent = substr($xmlcontent,0,strlen($xmlcontent) -1);
	$xmlcontent .= ');' . "\n";
	$xmlcontent .= '            ]]>' . "\n";
	$xmlcontent .= '        </mysql>' . "\n";
	
	// Get all values for the element
	$result_values = XT::query("
    SELECT
        *
    FROM 
        " . XT::getTable("forms_elements_values") . "
    WHERE
        element_id=" . $row['element_id']
,__FILE__,__LINE__);
	$r = array();
	$sqldata = array();
	$row_value = "";
	while($row_value = $result_values->fetchRow()){
		$xmlcontent .= '    <value>' . "\n";
		$xmlcontent .= '        <mysql>' . "\n";
		$xmlcontent .= '            <![CDATA[' . "\n";
		$i = 0;
		foreach($row_value as $key=>$value) {
			if ($key != "id"){
				$r[$i]['key'] = $key;
				if ($key == "element_id"){
					$r[$i]['value'] = "xx";
				} else {
					$r[$i]['value'] = $value;
				}
			}
			$i++;
		}
		$xmlcontent .= '            INSERT INTO {PREFIX}forms_elements_values (';
		foreach ($r as $sqldata) {
			$xmlcontent .= '`' . $sqldata['key'] . '`,';
		}
		$xmlcontent = substr($xmlcontent,0,strlen($xmlcontent) -1);
		$xmlcontent .= ')VALUES(';
		
		foreach ($r as $sqldata) {
			$xmlcontent .= '\'' . $sqldata['value'] . '\',';
		}
		$xmlcontent = substr($xmlcontent,0,strlen($xmlcontent) -1);
		$xmlcontent .= ');' . "\n";
		$xmlcontent .= '            ]]>' . "\n";
		$xmlcontent .= '        </mysql>' . "\n";
		$xmlcontent .= '    </value>' . "\n";
	}
	
	// Get all rules for the element
	$result_rule = XT::query("
    SELECT
        *
    FROM 
        " . XT::getTable("forms_elements_rules") . "
    WHERE
        element_id=" . $row['element_id']
,__FILE__,__LINE__);
	$r = array();
	$sqldata = array();
	$row_value = "";
	while($row_rule = $result_rule->fetchRow()){
		$xmlcontent .= '    <rule>' . "\n";
		$xmlcontent .= '        <mysql>' . "\n";
		$xmlcontent .= '            <![CDATA[' . "\n";
		$i = 0;
		foreach($row_rule as $key=>$value) {
			if ($key != "id"){
				$r[$i]['key'] = $key;
				if ($key == "element_id"){
					$r[$i]['value'] = "xx";
				}elseif($key == "form_id") {
					$r[$i]['value'] = "xy";	
				}else{
					$r[$i]['value'] = $value;
				}
				$i++;
			}
		}
		
		// recognise scripts
		if ($row_rule["compare_type"] == 4){
			$scripts[$row_rule["value"]] = $row_rule["value"];
		}
		
		$xmlcontent .= '            INSERT INTO {PREFIX}forms_elements_rules (';
		foreach ($r as $sqldata) {
			$xmlcontent .= '`' . $sqldata['key'] . '`,';
		}
		$xmlcontent = substr($xmlcontent,0,strlen($xmlcontent) -1);
		$xmlcontent .= ')VALUES(';
		
		foreach ($r as $sqldata) {
			$xmlcontent .= '\'' . $sqldata['value'] . '\',';
		}
		$xmlcontent = substr($xmlcontent,0,strlen($xmlcontent) -1);
		$xmlcontent .= ');' . "\n";
		$xmlcontent .= '            ]]>' . "\n";
		$xmlcontent .= '        </mysql>' . "\n";
		$xmlcontent .= '    </rule>' . "\n";
	}
	
	$xmlcontent .= '    </element>' . "\n";
	
}
/*
 * Actions
 */
$result = XT::query("
    SELECT
        *
    FROM 
        " . XT::getTable("forms_actions") . "
    WHERE
        form_id=" . $formid
,__FILE__,__LINE__);

while($row = $result->fetchRow()){
	$r = array();
	$sqldata = array();
	$xmlcontent .= '    <action>' . "\n";
	$xmlcontent .= '        <mysql>' . "\n";
	$xmlcontent .= '            <![CDATA[' . "\n";
	$i = 0;
	// Set the value to the home 10000 because you don't know the target template of the  target system
	// You have to set the redirect to a page by your own.
	if ($row["type"] == 7) {
		$row["value"] = 10000;
	}
	foreach($row as $key=>$value) {
		if ($key != "id"){
			$r[$i]['key'] = $key;
			if ($key == "form_id"){
				$r[$i]['value'] = "xx";
			} else {
				$r[$i]['value'] = $value;
			}
		}
		$i++;
	}
	// recognise scripts
	if ($row["type"] == 3){
		$scripts[$row["value"]] = $row["value"];
	}
	
	$xmlcontent .= '            INSERT INTO {PREFIX}forms_actions (';
	foreach ($r as $sqldata) {
		$xmlcontent .= '`' . $sqldata['key'] . '`,';
	}
	$xmlcontent = substr($xmlcontent,0,strlen($xmlcontent) -1);
	$xmlcontent .= ')VALUES(';
	
	foreach ($r as $sqldata) {
		$xmlcontent .= '\'' . $sqldata['value'] . '\',';
	}
	$xmlcontent = substr($xmlcontent,0,strlen($xmlcontent) -1);
	$xmlcontent .= ');' . "\n";
	$xmlcontent .= '            ]]>' . "\n";
	$xmlcontent .= '        </mysql>' . "\n";
 	$xmlcontent .= '    </action>' . "\n";
	
}

/*
 * Actions
 */
$result = XT::query("
    SELECT
        *
    FROM 
        " . XT::getTable("forms_preactions") . "
    WHERE
        form_id=" . $formid
,__FILE__,__LINE__);

while($row = $result->fetchRow()){
	$r = array();
	$sqldata = array();
	$xmlcontent .= '    <preaction>' . "\n";
	$xmlcontent .= '        <mysql>' . "\n";
	$xmlcontent .= '            <![CDATA[' . "\n";
	$i = 0;
	foreach($row as $key=>$value) {
		if ($key != "id"){
			$r[$i]['key'] = $key;
			if ($key == "form_id"){
				$r[$i]['value'] = "xx";
			} else {
				$r[$i]['value'] = $value;
			}
		}
		$i++;
	}
	// recognise scripts
	if ($row["type"] == 3){
		$scripts[$row["value"]] = $row["value"];
	}
	
	$xmlcontent .= '            INSERT INTO {PREFIX}forms_preactions (';
	foreach ($r as $sqldata) {
		$xmlcontent .= '`' . $sqldata['key'] . '`,';
	}
	$xmlcontent = substr($xmlcontent,0,strlen($xmlcontent) -1);
	$xmlcontent .= ')VALUES(';
	
	foreach ($r as $sqldata) {
		$xmlcontent .= '\'' . $sqldata['value'] . '\',';
	}
	$xmlcontent = substr($xmlcontent,0,strlen($xmlcontent) -1);
	$xmlcontent .= ');' . "\n";
	$xmlcontent .= '            ]]>' . "\n";
	$xmlcontent .= '        </mysql>' . "\n";
 	$xmlcontent .= '    </preaction>' . "\n";
}
if (is_array($scripts)){
	foreach($scripts as $script){
		/*
		 * Insert scripts
		 */
		$result = XT::query("
		    SELECT
		        *
		    FROM 
		        " . XT::getTable("forms_scripts") . "
		    WHERE
		        id=" . $script
			,__FILE__,__LINE__);
		$row = $result->fetchRow();
		$r = array();
		$sqldata = array();
		$i = 0;
		
		// Adjust the title to detect the data later
		$row["title"] = $row["title"] . " (IMPORTED " . date("d.m.Y") . " )";
		
		foreach($row as $key=>$value) {
			if ($key != "id"){
				$r[$i]['key'] = $key;
				$r[$i]['value'] = $value;
				$i++;
			} else {
				$id = $value;
			}
			
		}
		
		
		$xmlcontent .= '    <script>' . "\n";
		$xmlcontent .= '        <id>' . $id . '</id>' . "\n";
		$xmlcontent .= '        <mysql>' . "\n";
		$xmlcontent .= '            <![CDATA[' . "\n";
		$xmlcontent .= '            INSERT INTO {PREFIX}forms_scripts (';
		foreach ($r as $sqldata) {
			$xmlcontent .= '`' . $sqldata['key'] . '`,';
		}
		$xmlcontent = substr($xmlcontent,0,strlen($xmlcontent) -1);
		$xmlcontent .= ')VALUES(';
		
		foreach ($r as $sqldata) {
			$xmlcontent .= '\'' . $sqldata['value'] . '\',';
		}
		$xmlcontent = substr($xmlcontent,0,strlen($xmlcontent) -1);
		$xmlcontent .= ');' . "\n";
		$xmlcontent .= '            ]]>' . "\n";
		$xmlcontent .= '        </mysql>' . "\n";
		$xmlcontent .= '        <code>' . "\n";
		$xmlcontent .= '            <![CDATA[' . "\n";
		
		$file_content = file_get_contents(DATA_DIR . 'scripts/ch.iframe.snode.formmanager/' . $id . '.php');
		$file_content = str_replace("<?php","",$file_content);
		$file_content = str_replace("<?","",$file_content);
		$file_content = str_replace("?>","",$file_content);
		$xmlcontent .= $file_content;
		$xmlcontent .= '            ]]>' . "\n";
		$xmlcontent .= '        </code>' . "\n";
	 	$xmlcontent .= '    </script>' . "\n";
	}
}
$xmlcontent .= '</form>';
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Datum in der Vergangenheit
header("Content-Type: application/octet-stream");
header('Content-Disposition: attachment; filename="' . $form_name . '.xml"');
echo utf8_encode($xmlcontent);

/*file_put_contents(ROOT_DIR . "tmp/"  . $form_name . '.xml',utf8_encode($xmlcontent));
echo ("Location: " . WEBROOT_DIR . "xt/tmp/"  . $form_name . '.xml');*/
exit;
/**
 * TODO: The file output starts with a blank line so that the xml file isn't valid. What generates this blank line?
 */
?>