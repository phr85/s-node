<?php


$GLOBALS['plugin']->contribute('edit_buttons','Save', 'saveReport','disk_blue.png','0');// button wird defininiert

// für das listen der ienträge verantwortlich
XT::loadClass("ordering.class.php","ch.iframe.snode.core");
$order = new XT_Order("id,title","title",1,"list");
$order->setListener("sort","sortby");

// zuständig für die anzeigen des formpickers
XT::enableAdminCharFilter('title');
XT::enableAdminNavigator('forms');


//timmer implementation aus dem system
	/*$poll = array();
	
    // timer
    $time['type']=$poll['display_time_type'];

    for ($i=0;$i<24;$i++){
        if($i == date('H',$poll['display_time_start'])){
            $time['shour'][$i]=true;
        }else{
            $time['shour'][$i]=false;
        }
        if($i == date('H',$poll['display_time_end'])){
            $time['ehour'][$i]=true;
        }else{
            $time['ehour'][$i]=false;
        }
    }

    for ($i=0;$i<60;$i= $i+5){
        if($i == intval(date('i',$poll['display_time_start']))){
            $time['smin'][$i]=true;
        }else{
            $time['smin'][$i]=false;
        }
        if($i == intval(date('i',$poll['display_time_end']))){
            $time['emin'][$i]=true;
        }else{
            $time['emin'][$i]=false;
        }
    }

    switch ($poll['display_time_type']) {
    	case 0:
            $time['sdate']=0;
            $time['sdate_str']=0;
            $time['edate']=0;
            $time['edate_str']=0;
    		break;
		case 1:
		    $time['sdate']= $poll['display_time_start'] > 0 ? $poll['display_time_start'] : time();
            $time['sdate_str']=$poll['display_time_start'] > 0 ? date('d.m.Y',$poll['display_time_start']) : date('d.m.Y', time());
            $time['edate']=0;
            $time['edate_str']=0;
            break;
        case 2:
            $time['sdate']= 0;
            $time['sdate_str']=0;
            $time['edate']= $poll['display_time_end'] > 0 ? $poll['display_time_end'] : time();
            $time['edate_str']=$poll['display_time_end'] > 0 ? date('d.m.Y',$poll['display_time_end']) : date('d.m.Y', (time() + 86400));
            break;
        case 3:
            $time['sdate']= $poll['display_time_start'] > 0 ? $poll['display_time_start'] : time();
            $time['sdate_str']=$poll['display_time_start'] > 0 ? date('d.m.Y',$poll['display_time_start']) : date('d.m.Y', time());
            $time['edate']= $poll['display_time_end'] > 0 ? $poll['display_time_end'] : time();
            $time['edate_str']=$poll['display_time_end'] > 0 ? date('d.m.Y',$poll['display_time_end']) : date('d.m.Y', (time() + 86400));
            break;
    	default:
    	    $time['sdate']= $poll['display_time_start'] > 0 ? $poll['display_time_start'] : time();
            $time['sdate_str']=$poll['display_time_start'] > 0 ? date('d.m.Y',$poll['display_time_start']) : date('d.m.Y', time());
            $time['edate']= $poll['display_time_end'] > 0 ? $poll['display_time_end'] : time();
            $time['edate_str']=$poll['display_time_end'] > 0 ? date('d.m.Y',$poll['display_time_end']) : date('d.m.Y', (time() + 86400));

    		break;
    }
    */
    
  	$time['sdate']= XT::getValue('sdate') > 0 ? XT::getValue('sdate') : time();
    $time['sdate_str']= XT::getValue('sdate') > 0 ? date('d.m.Y',XT::getValue('sdate')) : date('d.m.Y', time());
    $time['edate']= XT::getValue('edate')> 0 ? XT::getValue('edate'): time();
    $time['edate_str']=XT::getValue('edate') > 0 ? date('d.m.Y',XT::getValue('edate')) : date('d.m.Y', (time() + 86400));
    
//alle vorhanden formulare listen 
$result = XT::query("
    SELECT
        id,
        title,
        active
    FROM
        " . $GLOBALS['plugin']->getTable("forms") .  "
    WHERE
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
        " . XT::getAdminCharFilter('AND') . "
    " . $order->get() . "
    LIMIT
            " . XT::getAdminNavigatorLimit() . "
    ",__FILE__,__LINE__);

$reto= XT::getQueryData($result);   

XT::assign("DATA", $reto); //übergabe der daten an das template


    XT::setSessionValue('SDATE', $time[sdate]);
    XT::setSessionValue('SDATE', $time[edate]);
    
    //assigns für die templates
    XT::assign('TIME',$time);
    XT::assign('DATE_PICKER_TPL',305);
    XT::assign('PICKEDFORM', XT::getSessionValue("pickedForm"));
    
	//contentumschaltung
    $content = XT::build('add.tpl');



?>