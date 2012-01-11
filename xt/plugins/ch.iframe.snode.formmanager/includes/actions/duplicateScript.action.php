<?php
$result = XT::query("
    SELECT
        title,
        description,
        script
    FROM 
        " . XT::getTable("forms_scripts") . "
    WHERE
        id=" . XT::getValue("script_id")
,__FILE__,__LINE__);

$row = $result->fetchRow();

$result = XT::query("
    INSERT INTO
        " . XT::getTable("forms_scripts") . "
        (title,description,script) 
    VALUES
        ('" . addslashes($row['title']) . "','" . addslashes($row['description']) . "', '" . addslashes($row['script']) . "')
",__FILE__,__LINE__);

$result = XT::query("
        SELECT
            MAX(id) AS id
        FROM
            " . XT::getTable("forms_scripts")
        ,__FILE__,__LINE__);

$row = $result->fetchRow();
$source = DATA_DIR . 'scripts/ch.iframe.snode.formmanager/' . XT::getValue("script_id") . '.php';
$destination = DATA_DIR . 'scripts/ch.iframe.snode.formmanager/' . $row['id'] . '.php';

$continue = true;

if (!is_file($source)) {
	XT::log("Could not find " . XT::getValue("script_id") . ".php", __FILE__,__LINE__, XT_ERROR);
	$continue = false;
}

if (!is_writable(DATA_DIR . 'scripts/ch.iframe.snode.formmanager/')) {
	XT::log("Cannot write to " .DATA_DIR . 'scripts/ch.iframe.snode.formmanager/', __FILE__,__LINE__, XT_ERROR);
	$continue = false;
}

if ($continue) {
	if (!copy($source, $destination)) {
		XT::log("Copy process failed", __FILE__, __LINE__, XT_ERROR);
	}
}
?>