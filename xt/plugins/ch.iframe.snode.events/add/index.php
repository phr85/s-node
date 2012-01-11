<?php
// Parameter :: Style
$style = $GLOBALS['plugin']->getParam('style') != '' ? $GLOBALS['plugin']->getParam('style') : 'default.tpl';

if (XT::isLoggedIn() && XT::getPermission('selfmanage')) {
	
	require_once(CLASS_DIR . "widgets/tree.widget.class.php");
	$treewidget = new XT_WidgetTree;
	$treewidget->addDetails('title','active','public');
	$count = $treewidget->buildTree('events_tree','events_tree_details','%s','',$in);
	$tdata = $treewidget->getData();
	
	XT::assign("TDATA", $tdata);


 

	
	XT::assign('TIME',$time);
	XT::assign('DATE_PICKER_TPL',305);
	// <-timer
	
	
	
	
	
	
	// Get addresses
	$result = XT::query("
	    SELECT
	        *
	    FROM
	        " . XT::getTable('addresses') . "
		WHERE
			user_id = " . XT::getUserid() . "
	    ORDER BY
	        title ASC
	",__FILE__,__LINE__);
	
	XT::assign("ADDRESSES",XT::getQueryData($result));
	$days_in_month = date("t", time());
	
	$hours = array();
	
	for($i = 1; $i < 25; $i++) {
	    array_push($hours, $i);
	}
	
	$days = array();
	
	for($i = 1; $i < ($days_in_month + 1); $i++) {
	    array_push($days, $i);
	}
	
	$months = array();
	
	for($i = 1; $i < 13; $i++) {
	    array_push($months, $i);
	}
	
	$years = array();
	
	for($i = (date("Y", time()) - 10); $i < 2031; $i++) {
	    array_push($years, $i);
	}
	
	
	// timer
	$time['type']=$row['display_time_type'];
	
	for ($i=0;$i<24;$i++){
	    if($i == date('H',$row['display_time_start'])){
	        $time['shour'][$i]=true;
	    }else{
	        $time['shour'][$i]=false;
	    }
	    if($i == date('H',$row['display_time_end'])){
	        $time['ehour'][$i]=true;
	    }else{
	        $time['ehour'][$i]=false;
	    }
	}
	
	for ($i=0;$i<60;$i= $i+5){
	    if($i == intval(date('i',$row['display_time_start']))){
	        $time['smin'][$i]=true;
	    }else{
	        $time['smin'][$i]=false;
	    }
	    if($i == intval(date('i',$row['display_time_end']))){
	        $time['emin'][$i]=true;
	    }else{
	        $time['emin'][$i]=false;
	    }
	}
	$from_date = time();
    $time['sdate']=  time();
    $time['sdate_str']= date('d.m.Y', time());
    $time['edate']= time() + 86400;
    $time['edate_str']= date('d.m.Y', (time() + 86400));
	
	
	XT::assign('TIME',$time);
	XT::assign("HOURS",  $hours);
	XT::assign("HOUR_SELECTED", date("H", $from_date));
	
	XT::assign("DAYS",   $days);
	XT::assign("DAY_SELECTED", date("d", $from_date));
	
	XT::assign("MONTHS", $months);
	XT::assign("MONTH_SELECTED", date("m", $from_date));
	
	XT::assign("YEARS",  $years);
	XT::assign("YEAR_SELECTED", date("Y", $from_date));
	
	// Images
	XT::assign("IMAGE_PICKER_TPL", XT::getConfig("image_picker_tpl"));
	XT::assign("IMAGE_PICKER_BASE_ID", XT::getConfig("image_picker_base_id"));
	
	// Forms
	XT::assign("FORM_PICKER_TPL", XT::getConfig("form_picker_tpl"));
	XT::assign("FORM_PICKER_BASE_ID", XT::getConfig("form_picker_base_id"));
	
	// Address
	XT::assign("ADDR_PICKER_TPL", XT::getConfig("ADDR_PICKER_TPL"));
	
	// Date
	XT::assign("DATE_PICKER_TPL", XT::getConfig("DATE_PICKER_TPL"));
	
} else {
	$style = "login.tpl";
}
 
$content = XT::build($style);
?>
