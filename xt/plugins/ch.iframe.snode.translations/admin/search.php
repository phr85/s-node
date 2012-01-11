<?php 
// Add buttons
XT::addImageButton('Search','searchTranslation','default','data_find.png','search');
// Add the expression
XT::assign("Q",XT::getValue("q"));

// Get installed packages
$result = XT::query("
    SELECT
        p.id, 
        p.package, 
        (p.version/1000) as version, 
        p.provider, 
        pd.title, 
        pd.description
    FROM 
        " . XT::getTable('plugins_packages') . " AS p LEFT JOIN
        " . XT::getTable('plugins_packages_details') . " AS pd ON (pd.id = p.id AND pd.lang = '" . $GLOBALS['plugin']->getActiveLang() . "')
    WHERE
        pd.title != ''
    ORDER BY 
       title ASC
", __FILE__, __LINE__);

$data = array();
$i = 0;
foreach (array_keys($GLOBALS['cfg']->getLangs()) as $lang) {
	if(is_file(ROOT_DIR . '/includes/lang/' . $lang . '.lang.php')){
	    include(ROOT_DIR . '/includes/lang/' . $lang . '.lang.php');
	    foreach ($messages[$lang] as $key=>$value){
	    	if (stristr($key,XT::getValue("q")) || stristr($value,XT::getValue("q"))) {
	    		$matches[$i]['key'] = $key;
	    		$matches[$i]['value'] = $value;
	    		$matches[$i]['lang'] = $lang;
	    		$matches[$i]['packagename'] = XT::translate('Global translations');
	    		$matches[$i]['package'] = 'global';
	    		$i++;  
	    	}
	    }
	}
}
while($row = $result->FetchRow()){
    foreach (array_keys($GLOBALS['cfg']->getLangs()) as $lang) {
	    if(is_file(PLUGIN_DIR . $row['package'] . '/includes/lang/' . $lang . '.lang.php')){
		    include(PLUGIN_DIR . $row['package'] . '/includes/lang/' . $lang . '.lang.php');
		    foreach ($plugin_messages[$lang] as $key=>$value){
		    	if (stristr($key,XT::getValue("q")) || stristr($value,XT::getValue("q"))) {
		    		$matches[$i]['key'] = $key;
		    		$matches[$i]['value'] = $value;
		    		$matches[$i]['lang'] = $lang;
		    		$matches[$i]['packagename'] = $row['title'];
		    		$matches[$i]['package'] =$row['package'];
		    		$i++;  
		    	}
		    }
		}	
    }
} 
XT::assign("MATCHES", $matches);

$content = XT::build('search.tpl'); 
?>