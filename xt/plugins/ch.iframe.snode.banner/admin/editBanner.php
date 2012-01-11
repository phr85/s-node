<?php

if($GLOBALS['plugin']->getValue("banner_id") != ''){
    $GLOBALS['plugin']->setSessionValue("banner_id", $GLOBALS['plugin']->getValue("banner_id"));
}

XT::assign("ACTIVE_ZONE", $GLOBALS['plugin']->getSessionValue("zone_id"));

$result = XT::query("
    SELECT
        a.id,
        a.title,
        a.description,
        a.image,
        a.code,
        a.image_version,
        b.type as image_type,
        b.width,
        b.height,
		a.width as bannerwidth,
		a.height as bannerheight,
        a.link_type,
        a.link,
        a.target,
        a.type,
        a.display_time_type,
        a.display_time_start,
        a.display_time_end
    FROM
        " . $GLOBALS['plugin']->getTable("banner") . " as a LEFT JOIN 
        " . $GLOBALS['plugin']->getTable("files") . " as b ON (b.id = a.image)
    WHERE 
        a.id = " . $GLOBALS['plugin']->getSessionValue("banner_id") . "
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

$banner = $data[0];

XT::assign("BANNER",$data[0]);

if($data[0]['link_type'] == 1){
    $result = XT::query("
        SELECT
            node_id,
            title
        FROM
            " . $GLOBALS['plugin']->getTable("navigation_details") .  "
        WHERE
            lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
            AND title != ''
        ORDER BY
            title ASC
    ",__FILE__,__LINE__);

    $pages = XT::getQueryData($result);

    XT::assign("PAGES",$pages);
}

// Get zones
$result = XT::query("
    SELECT
        a.id,
        a.title,
        a.width,
        a.height,
        rel.zone_id
    FROM
        " . $GLOBALS['plugin']->getTable("banner_zones") . " as a LEFT JOIN
        " . $GLOBALS['plugin']->getTable("banner_zones_rel") . " as rel ON (rel.zone_id = a.id AND rel.banner_id = " . $data[0]['id'] . ")
    ORDER BY
        a.title ASC
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}


XT::assign("ZONES",$data);

    // timer
    $time['type']=$banner['display_time_type'];
        
    for ($i=0;$i<24;$i++){
        if($i == date('H',$banner['display_time_start'])){
            $time['shour'][$i]=true;
        }else{
            $time['shour'][$i]=false;
        }
        if($i == date('H',$banner['display_time_end'])){
            $time['ehour'][$i]=true;
        }else{
            $time['ehour'][$i]=false;
        }
    }
    
    for ($i=0;$i<60;$i= $i+5){
        if($i == intval(date('i',$banner['display_time_start']))){
            $time['smin'][$i]=true;
        }else{
            $time['smin'][$i]=false;
        }
        if($i == intval(date('i',$banner['display_time_end']))){
            $time['emin'][$i]=true;
        }else{
            $time['emin'][$i]=false;
        }
    }

    switch ($banner['display_time_type']) {
    	case 0:
            $time['sdate']=0;
            $time['sdate_str']=0;
            $time['edate']=0;
            $time['edate_str']=0;
    		break;
		case 1:
		    $time['sdate']= $banner['display_time_start'] > 0 ? $banner['display_time_start'] : time();
            $time['sdate_str']=$banner['display_time_start'] > 0 ? date('d.m.Y',$banner['display_time_start']) : date('d.m.Y', time());
            $time['edate']=0;
            $time['edate_str']=0;
            break;
        case 2:
            $time['sdate']= 0;
            $time['sdate_str']=0;
            $time['edate']= $banner['display_time_end'] > 0 ? $banner['display_time_end'] : time();
            $time['edate_str']=$banner['display_time_end'] > 0 ? date('d.m.Y',$banner['display_time_end']) : date('d.m.Y', (time() + 86400));
            break;
        case 3:
            $time['sdate']= $banner['display_time_start'] > 0 ? $banner['display_time_start'] : time();
            $time['sdate_str']=$banner['display_time_start'] > 0 ? date('d.m.Y',$banner['display_time_start']) : date('d.m.Y', time());
            $time['edate']= $banner['display_time_end'] > 0 ? $banner['display_time_end'] : time();
            $time['edate_str']=$banner['display_time_end'] > 0 ? date('d.m.Y',$banner['display_time_end']) : date('d.m.Y', (time() + 86400));
            break;
    	default:
    	    $time['sdate']= $banner['display_time_start'] > 0 ? $banner['display_time_start'] : time();
            $time['sdate_str']=$banner['display_time_start'] > 0 ? date('d.m.Y',$banner['display_time_start']) : date('d.m.Y', time());
            $time['edate']= $banner['display_time_end'] > 0 ? $banner['display_time_end'] : time();
            $time['edate_str']=$banner['display_time_end'] > 0 ? date('d.m.Y',$banner['display_time_end']) : date('d.m.Y', (time() + 86400));

    		break;
    }


    XT::assign('TIME',$time);
    XT::assign('DATE_PICKER_TPL',305);
    
//Images
XT::assign("IMAGE_PICKER_TPL", $GLOBALS['plugin']->getConfig("image_picker_tpl"));
XT::assign("IMAGE_PICKER_BASE_ID", $GLOBALS['plugin']->getConfig("image_picker_base_id"));

XT::addImageButton("Save","saveBanner","default","disk_blue.png","0","slave1");
XT::addImageButton("Save and close","saveBannerAndClose","default","save_close.png","0","slave1");

$content = XT::build("editBanner.tpl");

?>
