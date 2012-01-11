<?php
// Register the xt_properties template function
$tpl->register_function("xt_getaddresses","xt_getaddresses");
function xt_getaddresses($params) {
    // Order by title by default
    if ($params['order_by'] == "") {
    	$params['order_by'] = "title";
    }
    // Order asc by default
    if (strtoupper($params['order']) == "ASC") {
    	$params['order'] = "ASC";
    } else {
    	$params['order'] = "DESC";
    }
    // save the query in a cache. So we just need one query if the function is called more then once in a request
    if (!is_array($GLOBALS["address" . $params['order_by'] . $params['order']])) {
    	$result = XT::query("SELECT * FROM " .  XT::getDatabasePrefix() . "addresses ORDER BY " . $params['order_by'] . " " . $params['order'],__FILE__,__LINE__);
    	 while($row = $result->FetchRow()){
            $GLOBALS["address" . $params['order_by'] . $params['order']][$row['id']] = $row;
        }
    }
    // just return the id if just an id is requested
    if (isset($params['id'])) {
    	$data = $GLOBALS["address" . $params['order_by'] . $params['order']][$params['id']];
    } else {
    	$data = $GLOBALS["address" . $params['order_by'] . $params['order']];    	
    }
    // Assign the content
    if ($params['assign'] == "") {
    	return XT::translate("No assign set. Please use the parameter assign=\"xyz\" to let set the template variable xyz.");
    } else {
		XT::clear_assign($params['assign']);
		XT::assign($params['assign'],$data);       	
    }
}

// Get all countries
$tpl->register_function("xt_getcountries","xt_getcountries");
function xt_getcountries($params) {
	if (!is_array($GLOBALS['countries'])) {
		// Get countries
		$result = XT::query("
	    SELECT
	        country,
	        name
	    FROM 
	        " .  XT::getDatabasePrefix() . "countries 
	    ORDER BY
	        name ASC
		",__FILE__,__LINE__);
		while($row = $result->FetchRow()){
			$GLOBALS['countries'][strtoupper($row['country'])] = $row;
		}
	}
	 // Assign the content
    if ($params['assign'] == "") {
    	return XT::translate("No assign set. Please use the parameter assign=\"xyz\" to let set the template variable xyz.");
    } else {
		XT::clear_assign($params['assign']);
		XT::assign($params['assign'],$GLOBALS['countries']);       	
    }
}

// Get country by country short name
$tpl->register_modifier("xt_getcountry", "xt_getcountry");
function xt_getcountry($value) {
	if (!is_array($GLOBALS['countries'])) {
		// Get countries
		$result = XT::query("
	    SELECT
	        *
	    FROM 
	        " .  XT::getDatabasePrefix() . "countries 
	    ORDER BY
	        name ASC
		",__FILE__,__LINE__);
		while($row = $result->FetchRow()){
			$GLOBALS['countries'][strtoupper($row['country'])] = $row;
		}
	}
	return $GLOBALS['countries'][strtoupper($value)]['name'];
}
?>