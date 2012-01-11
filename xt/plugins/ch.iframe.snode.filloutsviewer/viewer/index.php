<?php

XT::addImageButton('Search','search','default','data_find.png','0','','s','','');

//Get all forms
$result = XT::query("
    SELECT
       *
    FROM
        " . XT::getTable("forms") .  "
    ORDER BY title ASC;
    ",__FILE__,__LINE__);
XT::assign("DATA_FORMS", XT::getQueryData($result));
XT::assign("SELECTED_FORM", XT::getValue('form'));
XT::assign("SHOW_EMPTY", XT::getValue('showempty'));
// timer

if(XT::getValue('sdate_str')!=""){
    $sdate_pre = explode(".",XT::getValue('sdate_str'));
    $sdate = mktime(0,0,0,$sdate_pre[1],$sdate_pre[0],$sdate_pre[2]);
}else{
    $sdate = 'NULL';
}


if($sdate > 0){
    XT::setValue('sdate',mktime(XT::getValue('hstart') ,XT::getValue('mstart'),0,date('m',$sdate),date('d',$sdate),date('y',$sdate)));
}

if(XT::getValue('edate_str')!=""){
    $edate_pre = explode(".",XT::getValue('edate_str'));
    $edate = mktime(0,0,0,$edate_pre[1],$edate_pre[0],$edate_pre[2]);
}else{
    $edate = 'NULL';
}

if ($edate > 0){
    XT::setValue('edate',mktime(XT::getValue('hend') ,XT::getValue('mend'),0,date('m',$edate),date('d',$edate),date('y',$edate)));
}

if (XT::getValue('sdate')){
    $sdate = XT::getValue('sdate');
} else {
    $sdate = mktime(0,0,0,date("m",time()),date("d",time()),date("Y",time()));
}

if (XT::getValue('edate')){
    $edate = XT::getValue('edate');
} else {
    $edate = mktime(23,55,0,date("m",time()),date("d",time()),date("Y",time()));
}

// Time selection
for ($i=0;$i<24;$i++){
    if($i == date('H',$sdate)){
        $time['shour'][$i]=true;
    }else{
        $time['shour'][$i]=false;
    }
    if($i == date('H',$edate)){
        $time['ehour'][$i]=true;
    }else{
        $time['ehour'][$i]=false;
    }
}

for ($i=0;$i<60;$i= $i+5){
    if($i == intval(date('i',$sdate))){
        $time['smin'][$i]=true;
    }else{
        $time['smin'][$i]=false;
    }
    if($i == intval(date('i',$edate))){
        $time['emin'][$i]=true;
    }else{
        $time['emin'][$i]=false;
    }
}

$time['sdate'] = $sdate ;
$time['sdate_str'] = date('d.m.Y', $sdate );
$time['edate'] = $edate ;
$time['edate_str'] = date('d.m.Y', $edate );;

XT::assign('TIME',$time);
XT::assign('DATE_PICKER_TPL',305);

if (XT::getValue('form') && XT::getValue('sdate') && XT::getValue('edate')) {

    // get all elements by id
    $result_elements = XT::query("SELECT * FROM " . XT::getTable("forms_elements") ,__FILE__,__LINE__);
    while($row_elements = $result_elements->FetchRow()){
        $element_label[$row_elements["element_id"]] = $row_elements["label"];
    }
    /**
	 * Main search functionality
	 */
    $sql = "
	    SELECT
	       *
	    FROM
	        " . XT::getTable("forms_fillouts") ."
	    WHERE
	    	form_id = " . XT::getValue('form') . " AND start_date > " . XT::getValue('sdate') . " AND start_date < " . XT::getValue('edate') . "
	    ORDER BY start_date ASC;
	    ";

    $result = XT::query($sql,__FILE__,__LINE__);
    while($row = $result->FetchRow()){

        if ((XT::getValue('showempty') == 1 && $row['submission_date'] == 0 ) || $row['submission_date'] != 0 ){
            $result2 = XT::query("SELECT * FROM " . XT::getTable("forms")  . " WHERE id=" .$row["form_id"] ,__FILE__,__LINE__);
            $row2 = $result2->FetchRow();
            $data[$row['id']]['form_id'] = $row['form_id'];
            $data[$row['id']]['referer'] = $row['referer'];
            $data[$row['id']]['date_str'] = date("H:i d.m.Y",$row['start_date']);
            $data[$row['id']]['duration'] = round(($row['submission_date'] - $row['start_date'])/60);
            $data[$row['id']]['title'] = $row2['title'];
            $data[$row['id']]['lang'] = $row2['lang'];

            $result_data = XT::query("SELECT * FROM " . XT::getTable("forms_data")  . " WHERE fillout_id=" .$row["id"] ." ORDER BY element_id ASC",__FILE__,__LINE__);
            while($row_data = $result_data->FetchRow()){
                $data[$row['id']]['elements'][$row_data["id"]]['id'] = $row_data["element_id"];
                $data[$row['id']]['elements'][$row_data["id"]]['label'] = $element_label[$row_data["element_id"]];
                $data[$row['id']]['elements'][$row_data["id"]]['value'] = $row_data["element_value"];
            }
        }
    }
}
//echo "<pre>" . print_r($data,1) . "</pre>";
XT::assign('DATA',$data);

if(XT::getValue("action")=="export"){
    header("Content-type: application/text/plain");
    header('Content-Disposition: attachment; filename="form' . XT::getValue('form') . '.csv"');
    header('Cache-Control: max-age=15555000, must-revalidate');
    header("Last-Modified: " . gmdate("D, d M Y H:i:s",$fstat['mtime']) . " GMT");
    $content = XT::build('csv.tpl');
}else {
    $content = XT::build('default.tpl');
}

?>