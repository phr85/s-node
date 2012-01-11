<?php
$node_id = XT::getValue("node_id");
$package = XT::getValue("package");
$module = XT::getValue("module");
$params = XT::getValue("params");
$main_value = XT::getValue("main_value");
$lang = XT::getValue("lang");

if ($node_id != "" &&  $package != "" && $module != "" && $params != "" && $main_value != "") {
	 $result = XT::query("SELECT
	        MAX(position) + 1 AS position 
	    FROM 
	        " . XT::getTable('navigation_contents') . " 
	    WHERE 
	        node_id=" . $node_id . "
	    AND 
	        lang='" . $lang . "'", __FILE__, __LINE__);
	$row = $result->fetchRow();
	$position = $row['position'];
	
	if (!$position) {
	    $position = 1;
	}
	$sql = "INSERT INTO
	              " . XT::getTable('navigation_contents') . "
	              (node_id, package, module, position, active, lang, params, main_value)
	    VALUES
	        ($node_id, $package, '$module', $position, 1, '" . $lang . "','" . $params . "','" . $main_value . "')";
	
	$result = XT::query($sql, __FILE__, __LINE__);
} else {
	XT::log("Not enough parameter. Needed: node_id, package, module, params, main_value, lang.", __FILE__, __LINE__, XT_ERROR);
}
?>
