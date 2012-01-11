<?php
XT::addImageButton('Save','save','default','disk_blue.png','edit','slave1','s');
XT::addImageButton('Download V-Card','dlvcard','default','vcard.gif','edit','slave1','s');


$result = XT::query("
    SELECT
       *
    FROM
        " . XT::getTable('addresses') . "
    WHERE
	id = " . XT::getValue('id') . "
    ",__FILE__,__LINE__);
$data = XT::getQueryData($result);
XT::assign("DATA", $data[0]);

if (($data[0]['user_id'] == 0 || empty($data[0]['user_id'])) && $data[0]['email'] ) {
	XT::addImageButton('Add as Member','addMember','default','member2.png','edit','slave1');
}

// Get company list
$result = XT::query("
    SELECT
        title,
        id
    FROM
        " . $GLOBALS['plugin']->getTable("addresses") . "
    WHERE
        type = 1 AND id != " . XT::getValue('id') . "
    ORDER BY
        title ASC
",__FILE__,__LINE__);

$organizations = array();
while($row = $result->FetchRow()){
    $organizations[] = $row;
}
XT::assign("ORGANIZATIONS", $organizations);

// Get departments list
$result = XT::query("
    SELECT
        title,
        id
    FROM
        " . $GLOBALS['plugin']->getTable("addresses") . "
    WHERE
        type = 2 AND
        organization = " . $data[0]['organization'] . " AND id != " . XT::getValue('id') . "
    ORDER BY
        title ASC
",__FILE__,__LINE__);

$departments = array();
while($row = $result->FetchRow()){
    $departments[] = $row;
}


XT::assign("DEPARTMENTS", $departments);

// Get countries
$result = XT::query("SELECT c.country,l.name 
	FROM
    " . XT::getTable('countries') . " as c 
    LEFT JOIN 
    " . XT::getTable('countries_detail') . " as l on c.country = l.country 
    Where l.lang='" . XT::getActiveLang() . "' ORDER BY name ASC
",__FILE__,__LINE__);

XT::assign("COUNTRIES",XT::getQueryData($result));

// Get regions
$result = XT::query("
    SELECT
        region,
        name
    FROM
        " . XT::getTable('countries_regions') . "
    WHERE
        country = '" . $data[0]['country'] . "'
    ORDER BY
        name ASC
",__FILE__,__LINE__);



    // timer
    $time['type']=$data[0]['display_time_type'];

    for ($i=0;$i<24;$i++){
        if($i == date('H',$data[0]['display_time_start'])){
            $time['shour'][$i]=true;
        }else{
            $time['shour'][$i]=false;
        }
        if($i == date('H',$data[0]['display_time_end'])){
            $time['ehour'][$i]=true;
        }else{
            $time['ehour'][$i]=false;
        }
    }

    for ($i=0;$i<60;$i= $i+5){
        if($i == intval(date('i',$data[0]['display_time_start']))){
            $time['smin'][$i]=true;
        }else{
            $time['smin'][$i]=false;
        }
        if($i == intval(date('i',$data[0]['display_time_end']))){
            $time['emin'][$i]=true;
        }else{
            $time['emin'][$i]=false;
        }
    }

    switch ($data[0]['display_time_type']) {
    	case 0:
            $time['sdate']=0;
            $time['sdate_str']=0;
            $time['edate']=0;
            $time['edate_str']=0;
    		break;
		case 1:
		    $time['sdate']= $data[0]['display_time_start'] > 0 ? $data[0]['display_time_start'] : time();
            $time['sdate_str']=$data[0]['display_time_start'] > 0 ? date('d.m.Y',$data[0]['display_time_start']) : date('d.m.Y', time());
            $time['edate']=0;
            $time['edate_str']=0;
            break;
        case 2:
            $time['sdate']= 0;
            $time['sdate_str']=0;
            $time['edate']= $data[0]['display_time_end'] > 0 ? $data[0]['display_time_end'] : time();
            $time['edate_str']=$data[0]['display_time_end'] > 0 ? date('d.m.Y',$data[0]['display_time_end']) : date('d.m.Y', (time() + 86400));
            break;
        case 3:
            $time['sdate']= $data[0]['display_time_start'] > 0 ? $data[0]['display_time_start'] : time();
            $time['sdate_str']=$data[0]['display_time_start'] > 0 ? date('d.m.Y',$data[0]['display_time_start']) : date('d.m.Y', time());
            $time['edate']= $data[0]['display_time_end'] > 0 ? $data[0]['display_time_end'] : time();
            $time['edate_str']=$data[0]['display_time_end'] > 0 ? date('d.m.Y',$data[0]['display_time_end']) : date('d.m.Y', (time() + 86400));
            break;
    	default:
    	    $time['sdate']= $data[0]['display_time_start'] > 0 ? $data[0]['display_time_start'] : time();
            $time['sdate_str']=$data[0]['display_time_start'] > 0 ? date('d.m.Y',$data[0]['display_time_start']) : date('d.m.Y', time());
            $time['edate']= $data[0]['display_time_end'] > 0 ? $data[0]['display_time_end'] : time();
            $time['edate_str']=$data[0]['display_time_end'] > 0 ? date('d.m.Y',$data[0]['display_time_end']) : date('d.m.Y', (time() + 86400));

    		break;
    }


    XT::assign('TIME',$time);




XT::assign("REGIONS",XT::getQueryData($result));
// Image
XT::assign("IMAGE_PICKER_TPL", XT::getConfig("image_picker_tpl"));
XT::assign("IMAGE_PICKER_BASE_ID", XT::getConfig("image_picker_base_id"));
XT::assign("ADDRESSTYPES",XT::getConfig("ADDRESSTYPES"));
XT::assign("ADDRESSSTATES",XT::getConfig("ADDRESSSTATES"));
XT::assign("ACTIVE_LANG", XT::getPluginLang());
$content = XT::build("edit.tpl");
?>