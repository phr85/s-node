<?php

$dates = XT::autoVal('dates',"S");
$inputvalues = XT::getSessionValue('inputvalues');

$numberOfTimes = XT::autoval('numberOfTimes',"R");

$userdata = array();
$emptyinput = true;

// Check every input field. Is there any data?
foreach ($dates as $key => $date){
	for ($i=1;$i<$numberOfTimes;$i++){
		if (XT::getValue($date."_".$i) !=""){
			$emptyinput = false;
			$userdata[$date."_".$i] = XT::getValue($date."_".$i);
		}
	}
}

// If there was not any input given
if ($emptyinput){
	XT::setValue('step','times');
	XT::assign("xt" . XT::getBaseID() . "_errors",XT::translate('no input given'));
}else{
	XT::setValue('step','invite');
}

$content = XT::build('times.tpl');

XT::setSessionValue('inputvalues',$inputvalues);
XT::setSessionValue('userdata',$userdata);

?>