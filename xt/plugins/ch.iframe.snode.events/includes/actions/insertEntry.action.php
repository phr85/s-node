<?php
$event_id = XT::getSessionValue("source_node_id");
$node_id  = XT::getValue("node_id");

if (XT::getSessionValue("ctrl_copy_entry") == 1) {
	$result = XT::query("
	    SELECT 
        	events.id,
        	events.from_date,
        	events.end_date,
        	events.duration,
        	events.duration_type,
        	events.country,
        	events.region_id,
        	events.address,
        	events.door,
        	events.contact_person_id,
        	events.max_visitors,
        	events.costs,
        	events.display_time_type,
        	events.display_time_start,
        	events.display_time_end,
        	details.active,
        	details.lang,
        	details.title,
        	details.introduction,
        	details.maintext,
        	details.image,
        	details.image_version,
        	details.author,
        	details.form,
        	details.link,
        	details.link_external
        FROM 
        	" . XT::getTable("events") . " AS events LEFT JOIN 
        	" . XT::getTable("events_details") . " AS details 
        	ON (events.id = details.id)
        WHERE
        	events.id = " . $event_id . " AND
        	details.id = " . $event_id . " AND
        	details.lang = '" . XT::getPluginLang() . "'	
	",__FILE__,__LINE__);
	
    $data = $result->fetchRow();

    $result = XT::query("
        INSERT INTO
            " . XT::getTable("events") . "
            (
                from_date, 
                end_date, 
                duration,
                duration_type, 
                country,
        	    region_id,
        	    address,
        	    door,
        	    contact_person_id,
        	    max_visitors,
        	    costs,
        	    display_time_type,
        	    display_time_start,
        	    display_time_end
            ) VALUES (
                " . $data['from_date'] . ", 
                " . $data['end_date'] . ",
                " . $data['duration'] . ",
                '" . $data['duration_type'] . "',
                '" . $data['country'] . "',
                '" . $data['region_id'] . "',
                '" . $data['address'] . "',
                '" . $data['door'] . "',
                '" . $data['contact_person_id'] . "',
                '" . $data['max_visitors'] . "',
                '" . $data['costs'] . "',
                '" . $data['display_time_type'] . "',
                '" . $data['display_time_start'] . "',
                "  . $data['display_time_end'] . "
            )
    ",__FILE__,__LINE__);
    
    $result = XT::query("SELECT max(id) as id FROM " . XT::getTable("events"));
    $row = $result->fetchRow();
    $data['id'] = $row['id'];
    
    $result = XT::query("
        INSERT INTO
            " . XT::getTable("events_details") . "
            (
                id,
                active,
            	lang,
            	title,
            	introduction,
            	maintext,
                creation_date,
                creation_user,
            	image,
            	image_version,
            	author,
            	form,
        	    link,
        	    link_external
        	) VALUES (
        	    " . $data['id'] . ",
        	    0,
        	    '" . XT::getPluginLang() . "',
        	    '" . $data['title'] . "',
        	    '" . $data['introduction'] . "',
        	    '" . $data['maintext'] . "',
                '" . TIME . "',
                '" . $_SESSION['user']['id'] . "',
        	    '" . $data['image'] . "',
        	    '" . $data['image_version'] . "',
        	    '" . $data['author'] . "',
        	    '" . $data['form'] . "',
        	    '" . $data['link'] . "',
        	    '" . $data['link_external'] . "'
    	    )
    ",__FILE__,__LINE__);
    
    $result = XT::query("
        INSERT INTO 
            " . XT::getTable("events_tree_rel") . "
            (
                node_id,
                event_id
            ) VALUES (
                " . $node_id . ",
                " . $data['id'] . "
            );
    ",__FILE__,__LINE__);
}
elseif(XT::getSessionValue("ctrl_cut_entry") == 1) {
    XT::query("
        UPDATE 
            " . XT::getTable("events_tree_rel") . "
        SET
            node_id=" . $node_id ." 
        WHERE
            event_id=" . $event_id
    ,__LINE__,__LINE__,1);
        
        
}

XT::call("ctrlCancel");
?>