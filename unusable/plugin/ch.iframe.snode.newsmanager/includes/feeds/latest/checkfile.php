<?php

/**
 * category
 * pics_only
 * count
 */
$feed_dir = 'ch.iframe.snode.newsmanager/includes/feeds/latest/';

$result = XT::query("
    SELECT 
        node_id
    FROM 
        " . XT::getDatabasePrefix() . "newsmanager_tree_rel
    WHERE
        news_id = " . $entryID . "
", __FILE__, __LINE__);

$categories = array(0);
$query = "category=0";

/*
while ($row = $result->fetchRow()) {
	$query .= ',' . $row['node_id'];
	$categories[] = $row['node_id'];
}
*/
$query .= '&pics_only=0&count=0';
$md5 = md5($query);

if (!is_dir(PLUGIN_DIR . $feed_dir . $md5)) {
    foreach ($categories as $value) {
    	
        XT::query("
            INSERT INTO 
                " . XT::getDatabasePrefix() . "feedmanager_requests
            (
                md5, 
                profile, 
                name, 
                value
            ) VALUES (
                '" . $md5 . "', 
                " . $profile . ", 
                'category', 
                '" . $value . "'
            )
        ",__FILE__,__LINE__);
	}
	
	XT::query("
	    INSERT INTO
	       " . XT::getDatabasePrefix() . "feedmanager_requests
	    (
            md5, 
            profile, 
            name, 
            value
        ) VALUES (
            '" . $md5 . "', 
            " . $profile . ", 
            'pics_only',
            '0'
        )
	",__FILE__, __LINE__);
	
	XT::query("
	    INSERT INTO
	       " . XT::getDatabasePrefix() . "feedmanager_requests
	    (
            md5, 
            profile, 
            name, 
            value
        ) VALUES (
            '" . $md5 . "', 
            " . $profile . ", 
            'count',
            '0'
        )
	",__FILE__, __LINE__);
	
	mkdir(PLUGIN_DIR . $feed_dir . $md5);
}

$fp = fopen(PLUGIN_DIR . $feed_dir . $md5 . '/.update','w');
fclose($fp);

?>